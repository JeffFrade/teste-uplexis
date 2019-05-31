@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Artigos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                    {{ Form::open(['route' => 'article.index', 'method' => 'GET']) }}
                        <div class="col-sm-10">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Título" value="{{ $params['search'] ?? '' }}">
                        </div>

                    <div class="col-sm-2">
                        <button class="btn btn-warning btn-filter"><i class="fa fa-search"></i> Filtrar</button>
                    </div>
                    {{ Form::close() }}
                </div>

                <div class="box-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Link</th>
                                <th nowrap="" style="width: 1%">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($articles as $article)
                                <tr>
                                    <td>{{ $article->titulo }}</td>
                                    <td>{{ $article->link }}</td>
                                    <td nowrap="" style="width: 1%" class="text-center">
                                        <a href="#" class="btn btn-danger btn-xs btn-del" data-id="{{ $article->id }}"><i class="fa fa-ban"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Não há dados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="box-footer">
                    <div class="center-paginate">
                        {!! \App\Helpers\PaginateHelper::paginateWithParams($articles, $params) !!}
                    </div>
                </div>

                <div class="overlay hidden">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
        $('.btn-filter').on('click', function () {
            $('.overlay').removeClass('hidden');
        });

        $('.btn-del').on('click', function () {
            $('.overlay').removeClass('hidden');
            if (confirm('Deseja Deletar o Artigo?')) {
                $.ajax({
                    contentType: 'application/x-www-form-urlencoded',

                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'DELETE',

                    url: '/dashboard/article/' + $(this).data('id'),
                    timeout: 0,

                    success: function (response) {
                        $.notify({message: 'Artigo Deletado com Sucesso!'}, {type: 'success'})
                        setTimeout(function () {
                            location.reload();
                        }, 1200);
                    }
                });
            } else {
                $('.overlay').addClass('hidden');
            }
        });
    </script>
@stop

@section('css')
    <style type="text/css">
        .center-paginate {
            text-align: center;
        }

        .pagination > .active > a,
        .pagination > .active > a:focus,
        .pagination > .active > a:hover,
        .pagination > .active > span,
        .pagination > .active > span:focus,
        .pagination > .active > span:hover {
            background-color: #f39c12;
            border-color: #f39c12;
        }
    </style>
@stop
