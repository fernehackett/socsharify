@extends('shopify.default')

@section('page-header')
    Hello, {{ auth()->user()->name }}
@stop
@section('content')
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        {{ Form::open([
            "url" => route("shopify.store-templates.store"),
            "method" => "POST"
        ]) }}
        @sessionToken
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ $template->name ?? "" }}">
        </div>
        <div class="form-group">
            <label>Template</label>
            <select name="parent_id" class="form-control" required>
                <option value="">Select template</option>
                @foreach($_templates as $_template)
                    @php $cTemplate = ($_template->id == $template->parent->id) ? $_template : ($cTemplate ?? null); @endphp
                    <option @if($template && $_template->id == $template->parent->id) selected @endif value="{{ $_template->id }}">{{ $_template->display_name }}</option>
                @endforeach
            </select>
        </div>
        <div id="options" @class(["d-none" => !isset($cTemplate) && isset($cTemplate->options)])>
            <div class="options">
                @isset($cTemplate->options)
                    @foreach($cTemplate->options as $key => $option)
                        <div @class(["form-group"])>
                            <label>{{ ucfirst(str_replace("_"," ", $key)) }}</label>
                            @if(is_object($option["values"]) || is_array($option["values"]))
                                @if($option["type"] == "multiple")
                                <select class="select2" name="options[{{ $key }}][]" multiple data-maximum-selection-length="{{ $option["max"] }}">
                                    @foreach($option["values"] as $value)
                                        <option value="{{ $value }}" @if(isset($template->options[$key]) && in_array($value, $template->options[$key])) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @else
                                    <select class="form-control" name="options[{{ $key }}]">
                                        @foreach($option["values"] as $value)
                                            <option value="{{ $value }}" @if(isset($template->options[$key]) && $template->options[$key] == $value) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            @else
                                <input @class(["form-control"]) type="text" name="options[{{ $key }}]" value="{{ $effect->options[$key] ?? $option }}">
                            @endif
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-outline-primary">Save</button>
        </div>
        {{ Form::close() }}
    </div>
@stop

@section('js')
    <script>
        actions.TitleBar.create(app, {title: 'Templates'});
        let _templates = JSON.parse(`{!! json_encode($_templates) !!}`);
        $("[name=\"parent_id\"]").on("change", function(e){
            let template_id = $(this).val();
            $("#options").removeClass("d-none");
            $("#options .options").html("");
            let options = _templates[template_id]["options"];
            let contentHtml = "";
            for(let key in options){
                let option = options[key];
                let label = (key.charAt(0).toUpperCase() + key.slice(1)).replaceAll("_"," ");
                let temp = `<div class="form-group"><label>${label}</label>`;
                if(typeof option["values"] == "object") {
                    if (option["type"] == "multiple") {
                        temp += `<select class="option-select2" name="options[${key}][]" multiple data-maximum-selection-length="${option["max"]}">`;
                        for (let k in option["values"]) {
                            let value = option["values"][k];
                            temp += `<option value="${value}">${value}</option>`
                        }
                        temp += `</select>`;
                    }else{
                        temp += `<select class="form-control" name="options[${key}]">`;
                        for (let k in option["values"]) {
                            let value = option["values"][k];
                            temp += `<option value="${value}">${value}</option>`
                        }
                        temp += `</select>`;
                    }
                }else{
                    temp += `<input type="text" class="form-control" name="options[${key}]" value="${option}">`
                }
                temp += `</div>`;
                contentHtml += temp;
            }
            $("#options .options").html(contentHtml);
            $(".option-select2").select2();
        })
    </script>
@stop
