@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Список рецептов</h3>
                        @can('create', \App\Models\Recipe::class)
                            <a href="{{route('recipe.create')}}" class="btn btn-outline-success">Добавить рецепт</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($recipes as $recipe)
                                <a href="{{route('recipe.show',$recipe->id)}}" class="list-group-item list-group-item-action">{{$recipe->title}}</a>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            {{ $recipes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
