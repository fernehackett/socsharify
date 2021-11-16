@extends('shopify.default')

@section('page-header')
    Hello, {{ auth()->user()->name }}
@stop
@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        {{ Form::open([
            "url" => route("shopify.teamplate", request()->query()),
            "method" => "POST"
        ]) }}
        <div class="form-group">
            <label>Share This API</label>
            <input type="text" name="share_this_api" class="form-control" value="{{ auth()->user()->share_this_api }}">
        </div>
        <div class="form-check">
            <label class="form-label form-check-label">
                @isset($scriptTag)
                    <input type="hidden" name="script_id" value="{{ $scriptTag->script_id }}">
                @endisset
                <input class="form-check-input" name="active" value="on" type="checkbox" @isset($scriptTag) checked @endisset> Enable
                {{ config("app.name") }}
            </label>
        </div>
        <div class="form-actions mT-10">
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>
        {{ Form::close() }}
    </div>
@stop
