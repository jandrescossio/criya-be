<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Lookup;
use App\Models\Retailer;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/lookups', function () {
    return Lookup::all();
});

Route::get('/retailers', function () {
    return Retailer::all();
});

Route::get('/products', function (Request $request) {
    return Product::search($request->input('search'), function ($meiliSearch, $query, $options) use ($request) {
        $minPrice = $request->query('minPrice');
        $maxPrice = $request->query('maxPrice');

        if ($maxPrice > $minPrice) {
            $options['filter'] = "(price > $minPrice) AND (price < $maxPrice)";
        }

        $inStock = $request->query('inStock');
        $inStock = $inStock === 'true' ? 1 : 0;

        if ($inStock) {
            $options['filter'] = array_key_exists('filter', $options) ? $options['filter'] . " AND (in_stock = $inStock)" : "(in_stock = $inStock)";
        }

        return $meiliSearch->search($query, $options);
    })->orderBy('id', 'desc')->searchPaginateRaw(24);
});

Route::get('/products/{product}', function (Product $product) {

    return response()->json($product->toResponseArray());
});
