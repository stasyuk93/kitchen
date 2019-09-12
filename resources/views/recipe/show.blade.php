@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>{{$recipe->title}}</h1>
                        @can('update', $recipe)
                            <a class="btn btn-primary float-right" href="{{route('recipe.edit', $recipe->id)}}">Редактировать рецепт</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header h3">Ингредиенты</div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($recipe->ingredients as $ingredient)
                                        <li class="list-group-item">
                                            {{$ingredient->name}} &mdash; {{$ingredient->pivot->amount}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h4>Описание</h4>
                            <p>
                                {{$recipe->description}}
                            </p>
                        </div>
                        <div>Автор: {{$recipe->user->name}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
