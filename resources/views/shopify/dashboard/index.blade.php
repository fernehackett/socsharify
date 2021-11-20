@extends('shopify.default')

@section('page-header')
    Hello, {{ auth()->user()->name }}
@stop
@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        {{ Form::open([
            "url" => route("shopify.template"),
            "method" => "POST"
        ]) }}
        @sessionToken
        <div class="form-group">
            <label>Share This API</label>
            <input type="text" name="share_this_api" class="form-control" value="{{ auth()->user()->share_this_api }}">
        </div>
        <div class="form-check">
            <label class="form-label form-check-label">
                <input class="form-check-input" name="active" value="on" type="checkbox" @if(auth()->user()->enable == 1) checked @endisset> Enable
                {{ config("app.name") }}
            </label>
        </div>

        <div class="form-actions mT-10">
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>
        {{ Form::close() }}
    </div>
@stop
@section('js')
    <script>
        actions.TitleBar.create(app, {title: 'Home'});
    </script>
@stop

