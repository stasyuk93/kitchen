<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    const PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recipe.index',['recipes' => Recipe::paginate(self::PER_PAGE)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Recipe::class);
        return view('recipe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Recipe::class);
        $recipe = new Recipe([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'user_id' => Auth::id()
        ]);
        $recipe->save();
        if($request->has('ingredient')){
            foreach ($request->get('ingredient') as $item){
                if(empty($item['name'])) continue;
                $ingredient = Ingredient::firstOrCreate(
                    ['name' => $item['name']]
                );
                $recipe->ingredients()->attach(
                    $ingredient->id,
                    [
                        'amount' => $item['amount']
                    ]
                );
            }
        }

        return redirect()->route('recipe.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('recipe.show',[
            'recipe' => Recipe::with(['ingredients','user'])->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::with(['ingredients'])->findOrFail($id);

        $this->authorize('update', $recipe);

        return view('recipe.edit', ['recipe' => Recipe::with(['ingredients'])->findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $recipe = Recipe::with(['ingredients'])->findOrFail($id);
        $this->authorize('update', $recipe);

        $recipe->title = $request->get('title');
        $recipe->description = $request->get('description');
        $recipe->save();
        $ingredients = [];
        if($request->has('ingredient')) {
            foreach ($request->get('ingredient') as $item) {
                if (empty($item['name'])) continue;
                $ingredient = Ingredient::firstOrCreate(
                    ['name' => $item['name']]
                );
                $ingredients[$ingredient->id] = [
                    'amount' => $item['amount']
                ];
            }
        }
        $recipe->ingredients()->sync($ingredients);
        return redirect()->route('recipe.show', $recipe->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
