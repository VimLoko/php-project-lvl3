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
        <h1 class="mt-5 mb-3">{{__('messages.record.header_site')}}: {{ $urlRecord->name }}</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <td>{{__('messages.record.ID')}}</td>
                    <td>{{ $urlRecord->id }}</td>
                </tr>
                <tr>
                    <td>{{__('messages.record.record_name')}}</td>
                    <td>{{ $urlRecord->name }}</td>
                </tr>
                <tr>
                    <td>{{__('messages.record.record_created_at')}}</td>
                    <td>{{ $urlRecord->created_at }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
