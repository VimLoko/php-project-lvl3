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
    <div class="container-lg mt-3">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8 mx-auto border rounded-3 bg-light p-5">
                <h1 class="display-3">{{ __('messages.name_site')  }}</h1>
                <p class="lead">{{ __('messages.check_seo_for_free')  }}</p>
                {{ Form::open(['url' => route('urls.store'), 'class' => 'd-flex justify-content-center']) }}
                    {{ Form::text('url[name]', '', ['class' => 'form-control form-control-lg', 'placeholder' => 'https://www.example.com']) }}
                    {{ Form::submit(__('messages.btn_submit_check'), ['class' => 'btn btn-lg btn-primary ms-3 px-5 text-uppercase']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
