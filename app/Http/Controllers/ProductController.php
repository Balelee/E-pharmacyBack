<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

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

    public function storeProduct(Product $product, Request $resquest)
    {
        $resquest->validate([
            'productName' => Product::validationRule('productName'),
            'description' => Product::validationRule('description'),
            'price' => Product::validationRule('price'),
            'productType' => Product::validationRule('productType'),
            'stock' => Product::validationRule('stock'),
            'laborator' => Product::validationRule('laborator'),
        ]);

        $product = Product::create([
            'productName' => $resquest->name,
            'description' => $resquest->description,
            'price' => $resquest->price,
            'productType' => $resquest->productType,
            'stock' => $resquest->stock,
            'laborator' => $resquest->laborator,
        ]);

        return new ProductResource($product->refresh());
    }

    public function updateProduct(Product $product, Request $resquest)
    {
        $resquest->validate([
            'productName' => Product::validationRule('productName'),
            'description' => Product::validationRule('description'),
            'price' => Product::validationRule('price'),
            'productType' => Product::validationRule('productType'),
            'stock' => Product::validationRule('stock'),
            'laborator' => Product::validationRule('laborator'),

        ]);

        $product->update([
            'productName' => $resquest->name,
            'description' => $resquest->description,
            'price' => $resquest->price,
            'productType' => $resquest->productType,
            'stock' => $resquest->stock,
            'laborator' => $resquest->laborator,
        ]);

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
