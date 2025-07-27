<?php

namespace App\Http\Controllers\Store;

use App\Filters\CategoryProductFilter;
use App\Filters\ColorProductFilter;
use App\Filters\FabricProductFilter;
use App\Filters\GenderProductFilter;
use App\Filters\PriceProductFilter;
use App\Filters\SearchProductFilter;
use App\Filters\SeasonProductFilter;
use App\Filters\SizeProductFilter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Pipeline;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Category $category)
    {

        $filters = [
            new SearchProductFilter($request->get('term') ?? null),
            new CategoryProductFilter($category->exists ? $category->id : null),
            new GenderProductFilter($request->has('filters.gender') ? $request->get('filters')['gender'] : null),
            new FabricProductFilter($request->has('filters.fabric') ? $request->get('filters')['fabric'] : null),
            new SeasonProductFilter($request->has('filters.season') ? $request->get('filters')['season'] : null),
            new PriceProductFilter($request->has('filters.price') ? $request->get('filters')['price'] : null),
            new SizeProductFilter($request->has('filters.size') ? $request->get('filters')['size'] : null),
            new ColorProductFilter($request->has('filters.color') ? $request->get('filters')['color'] : null),
        ];

        $products = Pipeline::send(Product::query())
            ->through($filters)
            ->thenReturn()
            ->paginate(perPage: $request->per_page ?? 32)
            ->withQueryString();

        //        dd(Category::search('suit')->get());
        //        dd(Product::search('Eum et.')->get()->pluck('name', 'id')->toArray());

        return view('store.catalog.products.index', compact('category', 'products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Product $product)
    {
        $products = Product::where('category_id', $category->id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(16)
            ->get();

        return view('store.pages.product.index', compact('category', 'product','products'));
    }
}
