<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Storage;

class ProductController extends BaseController
{
    public function getProducts(Request $request) // Function de recuperation des produits
    {
        $prductoQuery = Product::query()->orderBy('id', 'desc');
        if (! empty($this->seachValue)) {
            $prductoQuery->whereRaw('LOWER(productName) LIKE ?', ['%'.mb_strtolower($this->seachValue).'%']);
        }

        if ($request->has('filter') && ! empty($request->filter)) {
            $prductoQuery->where('pharmacy_id', $request->filter);
        }

        return ProductResource::collection($prductoQuery->paginate($this->limitPage));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'productImage' => Product::getValidationRule('productImage'),
            'productName' => Product::getValidationRule('productName'),
            'description' => Product::getValidationRule('description'),
            'price' => Product::getValidationRule('price'),
            'productType' => Product::getValidationRule('productType'),
            'stock' => Product::getValidationRule('stock'),
            'expiredDate' => Product::getValidationRule('expiredDate'),
            'laborator' => Product::getValidationRule('laborator'),
        ]);

        $product = Product::create([
            'pharmacy_id' => $request->pharmacy_id,
            'productImage' => null,
            'productName' => $request->productName,
            'description' => $request->description,
            'price' => $request->price,
            'productType' => $request->productType,
            'stock' => $request->stock,
            'expiredDate' => $request->expiredDate,
            'laborator' => $request->laborator,
        ]);

        if ($request->has('productImage') && is_string($request->productImage)) {
            $imageData = file_get_contents($request->productImage);
            $imageName = $product->id.'.png';
            Storage::disk('public')->put('produits/'.$imageName, $imageData);
            $imagePath = 'produits/'.$imageName;
            $product->update(['productImage' => $imagePath]);
        }

        return new ProductResource($product->refresh());
    }

    public function updateProduct(Product $product, Request $request)
    {
        $request->validate([
            'productImage' => Product::getValidationRule('productImage'),
            'productName' => Product::getValidationRule('productName'),
            'description' => Product::getValidationRule('description'),
            'price' => Product::getValidationRule('price'),
            'productType' => Product::getValidationRule('productType'),
            'stock' => Product::getValidationRule('stock'),
            'expiredDate' => Product::getValidationRule('expiredDate'),
            'laborator' => Product::getValidationRule('laborator'),
        ]);

        $product->update([
            'productImage' => null,
            'productName' => $request->productName,
            'description' => $request->description,
            'price' => $request->price,
            'productType' => $request->productType,
            'stock' => $request->stock,
            'expiredDate' => $request->expiredDate,
            'laborator' => $request->laborator,
        ]);

        if ($request->has('productImage') && is_string($request->productImage)) {
            $imageData = file_get_contents($request->productImage);
            $imageName = $product->id.'.png';
            if ($product->productImage && Storage::disk('public')->exists($product->productImage)) {
                Storage::disk('public')->delete($product->productImage);
            }
            Storage::disk('public')->put('produits/'.$imageName, $imageData);
            $imagePath = 'produits/'.$imageName;
            $product->update(['productImage' => $imagePath]);
        }

        return new ProductResource($product->refresh());
    }

    public function findProduct(Product $product)
    {
        return new ProductResource($product->refresh());
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return new ProductResource($product);
    }



    public function searchProduct(Request $request)
    {
        $query = $request->get('query');
        $limit = $request->get('limit', 20);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;

        $products = Product::where('productName', 'like', '%' . $query . '%')
            ->select('id', 'productName', 'price')
            ->offset($offset)
            ->limit($limit)
            ->get();

        $total = Product::where('productName', 'like', '%' . $query . '%')->count();

        return response()->json([
            'data' => $products,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
        ]);
    }


}
