<?php

namespace App\Http\Controllers\Shopify;

use App\Models\ScriptTag;
use App\Models\Template;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function teamplate(Request $request)
    {
        $user = auth()->user();
        $store_url = auth()->user()->name;
        if ($request->has("share_this_api")) {
            auth()->user()->update(["share_this_api" => $request->get("share_this_api")]);
        }
        if ($request->has("active") && $request->get("active") == "on") {
            try {
                $data = [
                    "script_tag" => [
                        "event"         => "onload",
                        "src"           => route("public.script-tags"),
                        "display_scope" => "online_store",
                    ]];
                $response = $user->createScriptTag($data);
                $scriptTag = ((array)$response["body"]["script_tag"])["container"];
                $scriptTag["script_id"] = $scriptTag["id"];
                $scriptTag["shopify_url"] = $store_url;
                $scriptTag["name"] = "effectify";
                unset($scriptTag["id"]);
                ScriptTag::create($scriptTag);
                return redirect()->to(route("home"));
            } catch (\Exception $e) {
                return redirect()->to(route("home"));
            }
        } else {
            try {
                $script_id = $request->get("script_id");
                $response = $user->deleteScriptTag($script_id);
                ScriptTag::where("script_id", $script_id)->delete();
            } catch (\Exception $e) {
                return redirect()->to(route("home"));
            }
            return redirect()->to(route("home"));
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
