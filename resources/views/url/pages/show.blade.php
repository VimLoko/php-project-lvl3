@extends('url.layouts.default')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('flash::message')
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайт: {{ $urlRecord->name }}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{ $urlRecord->id }}</td>
                </tr>
                <tr>
                    <td>Имя</td>
                    <td>{{ $urlRecord->name }}</td>
                </tr>
                <tr>
                    <td>Дата создания</td>
                    <td>{{ $urlRecord->created_at }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
