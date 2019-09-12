@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Добавить рецепт</div>
                    <div class="card-body">
                        <form action="{{route('recipe.update', $recipe->id)}}" method="post">
                            @method('put')
                            @csrf()
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input name="title" type="text" class="form-control" id="title" placeholder="Заголовок" value="{{$recipe->title}}">
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Ингредиенты
                                    <div class="btn btn-success" id="add_ingredient" count="{{count($recipe->ingredients)}}">Добавить</div>
                                </div>
                                <div class="card-body">
                                    @forelse($recipe->ingredients as $key => $ingredient)
                                        <div class="form-row mb-2" id="ingredient">
                                            <input name="ingredient[{{$key}}][name]" type="text" class="form-control col-7" placeholder="Ингредиент" value="{{$ingredient->name}}">
                                            <input name="ingredient[{{$key}}][amount]" type="text" class="form-control col-4" placeholder="Количество" value="{{$ingredient->pivot->amount}}">
                                            <div class="col-1"><i class='btn btn-outline-danger fa fa-close' style="font-size: 1.6em"></i></div>
                                        </div>
                                    @empty
                                        <div class="form-row mb-2" id="ingredient">
                                            <input name="ingredient[0][name]" type="text" class="form-control col-7" placeholder="Ингредиент">
                                            <input name="ingredient[0][amount]" type="text" class="form-control col-4" placeholder="Количество">
                                            <div class="col-1"><i class='btn btn-outline-danger fa fa-close' style="font-size: 1.6em"></i></div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Описание рецепта</label>
                                <textarea name="description" class="form-control" id="description" rows="3">{{$recipe->description}}</textarea>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#add_ingredient').click(function () {
            $(this).attr('count', +$(this).attr('count') + 1);
            var count = $(this).attr('count');
            var ingredient = $('#ingredient').clone();
            ingredient.children('input').each(function () {
                this.name = this.name.replace(/\d+/g, count);
                this.value = null;
            });
            $('#ingredient').parent().append(ingredient);
        });

        $('.fa-close').click(function () {
            $(this).parents('div.form-row').remove();
        });
    </script>
@endsection