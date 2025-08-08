<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;

class ProductController extends BaseController
{
    public function getProducts(Request $request) // Function de recuperation des produits
    {
        $prductoQuery = Product::query()->orderBy('id', 'asc');
        if (! empty($this->seachValue)) {
            $prductoQuery->whereRaw('LOWER(productName) LIKE ?', ['%'.mb_strtolower($this->seachValue).'%']);
        }

        return ProductResource::collection($prductoQuery->paginate($this->limitPage));
    }


    public function searchProduct(Request $request)
    {
        $query = $request->get('query');
        $limit = $request->get('limit', 30);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;

        $products = Product::where('productName', 'like', '%'.$query.'%')
            ->select('id', 'productName', 'price')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $total = Product::where('productName', 'like', '%'.$query.'%')->count();

        return response()->json([
            'data' => $products,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
        ]);
    }
}
