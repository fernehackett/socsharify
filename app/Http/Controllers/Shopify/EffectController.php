<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use App\Models\Effect;
use App\Models\EffectTemplate;
use App\Models\ScriptTag;
use App\Models\Store;
use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;

class EffectController extends Controller
{
    public function effectify(Request $request)
    {
        $user = auth()->user();
        $store_url = $user->name;
        if ($request->has("effectify") && $request->get("effectify") == "on") {
            try {
                $data = [
                    "script_tag" => [
                        "event"         => "onload",
                        "src"           => route("public.effectify"),
                        "display_scope" => "online_store",
                    ]];
                $response = $user->api()->rest('POST', '/admin/api/script_tags.json', $data);
                $scriptTag = ((array)$response["body"]["script_tag"])["container"];
                $scriptTag["script_id"] = $scriptTag["id"];
                $scriptTag["shopify_url"] = $store_url;
                $scriptTag["name"] = "effectify";
                unset($scriptTag["id"]);
                ScriptTag::create($scriptTag);
                return back()->withSuccess("Update successfully!");
            } catch (\Exception $e) {
                return back()->withSuccess("Update failed!");
            }
        } else {
            try {
                $script_id = $request->get("script_id");
                $response = $user->api()->rest('DELETE', "/admin/api/script_tags/{$script_id}.json");
                ScriptTag::where("script_id", $script_id)->delete();
            } catch (\Exception $e) {
                return back()->withSuccess("Update failed!");
            }
            return back()->withSuccess("Update successfully!");
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $store_url = $user->name;
        $effects = Effect::where("shopify_url", $store_url)->get();
        $effectTemplates = EffectTemplate::all();
        return view("shopify.effects.index", compact("effects", "effectTemplates"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $effectTemplates = EffectTemplate::all()->keyBy("id");
        return view("shopify.effects.create", compact("effectTemplates"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $store_url = $user->name;
        $request->request->add(["shopify_url" => $store_url]);
        Effect::create($request->all());
        return redirect(route("shopify.effects.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Effect $effect)
    {
        $effectTemplates = EffectTemplate::all()->keyBy("id");
        return view("shopify.effects.edit", compact("effect", "effectTemplates"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Effect $effect)
    {
        if (!$request->has("options")) $request->request->add(["options" => []]);
        $effect->update($request->all());
        return back()->withSuccess("Updated Done!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Effect $effect)
    {
        $effect->delete();
        return back()->withSuccess("Deleted Done!");
    }
}
