<?php

namespace App\Http\Controllers\Shopify;

use App\Models\DefaultTemplate;
use App\Models\ScriptTag;
use App\Models\Template;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function template(Request $request)
    {
        if ($request->has("share_this_api")) {
            auth()->user()->update(["share_this_api" => $request->get("share_this_api")]);
        }
        if ($request->has("active") && $request->get("active") == "on") {
            try {
                auth()->user()->update(["enable" => 1]);
                return redirect()->to(route("home",["notice" => "Saved!"]));
            } catch (\Exception $e) {
                return redirect()->to(route("home",["error" => "Failed!"]));
            }
        } else {
            try {
                auth()->user()->update(["enable" => 0]);
            } catch (\Exception $e) {
                return redirect()->to(route("home",["error" => "Failed!"]));
            }
            return redirect()->to(route("home",["notice" => "Saved!"]));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $_templates = DefaultTemplate::get()->keyBy("id");
        $template = Template::with("parent")->where("shopify_url", auth()->user()->name)->first();
        return view("shopify.templates.index", compact('_templates',"template"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $template = Template::where("shopify_url", auth()->user()->name)->first();
        if($template){
            $template->update($request->all());
        }else{
            $request->request->add(["shopify_url" => auth()->user()->name]);
            Template::create($request->all());
        }
        return redirect()->to(route("shopify.store-templates.index",["notice" =>"Saved!"]));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Template $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Template $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Template $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Template $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
