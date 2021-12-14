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
            <h2 class="mt-5 mb-3">Проверки</h2>
            {{ Form::open(['url' => route('check_url', ['id' => $urlRecord->id] )]) }}
                {{ Form::submit(__('messages.btn_submit_check_url'), ['class' => 'btn btn-primary mb-3']) }}
            {{ Form::close() }}
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>{{__('messages.table_checks.ID')}}</th>
                    <th>{{__('messages.table_checks.table_column_status_code')}}</th>
                    <th>{{__('messages.table_checks.table_column_created_at')}}</th>
                </tr>
                @if ($checks)
                    @foreach ($checks as $check)
                        <tr>
                            <td>{{ $check->id }}</td>
                            <td>{{ $check->status_code }}</td>
                            <td>{{ $check->created_at }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
