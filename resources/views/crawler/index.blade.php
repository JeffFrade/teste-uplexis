@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Captura</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Capturar Artigos</h3>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label for="search">Busca:</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Busca">
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ route('dashboard') }}" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>

                    <button class="btn btn-warning pull-right btn-run"><i class="fa fa-cogs"></i> Capturar</button>
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
        $('.btn-run').on('click', function () {
            $('.overlay').removeClass('hidden');
            $.ajax({
                contentType: 'application/x-www-form-urlencoded',

                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    search: $('#search').val()
                },
                method: 'POST',

                url: '/dashboard/crawler',
                timeout: 0,

                success: function (response) {
                    $('.overlay').addClass('hidden');
                    $.notify({message: response.msg}, {type: response.type})
                }
            });
        });
    </script>
@stop