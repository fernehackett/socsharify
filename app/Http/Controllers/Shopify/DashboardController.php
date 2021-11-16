<?php

namespace App\Http\Controllers\Shopify;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Models\ScriptTag;
use App\Models\Store;
use Illuminate\Http\Request;
use PHPShopify\ShopifySDK;

class DashboardController extends Controller
{
    protected $api_key, $api_secret, $scope;

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $scriptTag = ScriptTag::where("shopify_url", $user->name)->where("name", "effectify")->first();
        return response()->view("shopify.dashboard.index", [ "scriptTag" => $scriptTag]);
    }
}
