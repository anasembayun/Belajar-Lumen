<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response()->json([
            ['msg' => "get all product success"],
            $product]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $product = Product::create($data);

        return response()->json([
            ['msg' => "create product success"],
            $product]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
            ['msg' => "get detail product success"],
            $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json(
                ['message' => 'Data not found'], 404);
        }

        $data = $request->all();
        $product->fill($data);
        $product->save();

        return response()->json([
            ['msg' => "update product success"],
            $product]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        
        if (!$product) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
} 