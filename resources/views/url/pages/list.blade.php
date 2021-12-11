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
        <h1 class="mt-5 mb-3">Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Последняя проверка</th>
                </tr>
                @foreach ($urls as $url)
                    <tr>
                        <td>{{$url->id}}</td>
                        <td><a href="{{ route('urls.show', ['url' => $url->id]) }}">{{ $url->name }}</a></td>
                        <td>{{$url->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
    </div>
@stop
