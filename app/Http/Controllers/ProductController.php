<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductSearchRequest; 
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\StoreProductRequest;
class ProductController extends Controller
{
    public function index(ProductSearchRequest $request)
    {
        $query = Product::with('categories')
            ->orderBy('code');

        if ($request->has('q')) {
            $query->where('name', 'like', "%{$request->q}%")
                ->orWhere('code', 'like', "%{$request->q}%")
                ->orWhereHas('categories', function($query) use ($request) {
                    $query->where('category', 'like', "%{$request->q}%");
                });
        }

        $products = $query->paginate(10); 

        return response()->json($products->makeHidden('internal_notes'));
    }
    public function store(StoreProductRequest $request)
    {

        $validatedData = $request->validated();
        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->categories()->detach();
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }


}
