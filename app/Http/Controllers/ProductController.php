<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends BaseController
{
    public function getProducts()    // Function de recuperation des produits
    {
        $prductoQuery = Product::query()->orderBy('id', 'desc');
        if (! empty($this->seachValue)) {
            $prductoQuery->whereRaw('LOWER(productName) LIKE ?', ['%'.mb_strtolower($this->seachValue).'%'])
                ->orWhereRaw('LOWER(productType) LIKE ?', ['%'.mb_strtolower($this->seachValue).'%']);
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
}
