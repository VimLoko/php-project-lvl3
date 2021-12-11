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
        <h1 class="mt-5 mb-3">{{__('messages.menu_sites_page')}}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>{{__('messages.table.ID')}}</th>
                    <th>{{__('messages.table.table_column_name')}}</th>
                </tr>
                @if ($urls)
                    @foreach ($urls as $url)
                        <tr>
                            <td>{{$url->id}}</td>
                            <td><a href="{{ route('urls.show', ['url' => $url->id]) }}">{{ $url->name }}</a></td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
