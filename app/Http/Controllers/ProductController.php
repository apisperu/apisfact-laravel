<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $companyRuc = $request->input('companyRuc');

        if ($companyRuc) {
            return Product::where('companyRuc', '=', $companyRuc)->get();
        }
        return Product::all();
    }
 
    public function show($id)
    {
        return Product::find($id);
    }

    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return $product;
    }

    public function delete(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return 204;
    }
}
