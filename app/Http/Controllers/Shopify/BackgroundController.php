<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Models\Store;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $store_url = session("store_url", "");
        $store = Store::where("shopify_url", $store_url)->first();
        $backgrounds = Background::where("shopify_url", $store_url)->orderBy("id")->limit(10)->get();
        return view("shopify.backgrounds.index", compact("store","backgrounds"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $store_url = session("store_url", "");
        $store = Store::where("shopify_url", $store_url)->first();
        return view("shopify.backgrounds.create", compact("store"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $store_url = session("store_url", "");
        $request->request->add(["shopify_url" => $store_url]);
        Background::create($request->all());
        return redirect()->to(route("shopify.backgrounds.index"))->withSuccess("New template was saved successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Background $background
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Background $background)
    {
        $store_url = session("store_url", "");
        $store = Store::where("shopify_url", $store_url)->first();
        return view("shopify.backgrounds.edit", compact("store","background"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Background $background
     * @return Response
     */
    public function update(Request $request, Background $background)
    {
        $background->update($request->all());
        return back()->withSuccess("Template was saved successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Background $bg
     * @return Response
     */
    public function destroy(Background $bg)
    {
        $bg->delete();
        return back()->withSuccess("Template was saved successfully!");
    }
}
