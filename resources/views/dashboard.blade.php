@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="col-sm-4">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-newspaper-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Artigos</span>
                <span class="info-box-number">{{ $totalArticles }}</span>
            </div>
        </div>
    </div>
@stop