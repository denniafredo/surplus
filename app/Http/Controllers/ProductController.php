<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'data' => $products
        ], Response::HTTP_OK);
    }
    public function show($id)
    {
        $product = Product::find($id);
        return response()->json([
            'data' => $product
        ], Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $product = Product::create($request->all());
            $response = [
                'message' => 'Product created',
                'data' => $product
            ];
            return response()->json($response,Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $response = [
                'message' => 'Error : ' . $e->getMessage()
            ];
            return response()->json($response,Response::HTTP_CONFLICT);
        }
    }
    public function update( Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'enable' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $product->update($request->all());
            $response = [
                'message' => 'Product updated',
                'data' => $product
            ];
            return response()->json($response,Response::HTTP_OK);
        } catch (\Exception $e) {
            $response = [
                'message' => 'Error : ' . $e->getMessage()
            ];
            return response()->json($response,Response::HTTP_CONFLICT);
        }
    }
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
         
            $product->delete($id);
            $response = [
                'message' => 'Product deleted',
                'data' => $product
            ];
            return response()->json($response,Response::HTTP_OK);
        } catch (\Exception $e) {
            $response = [
                'message' => 'Error : ' . $e->getMessage()
            ];
            return response()->json($response,Response::HTTP_CONFLICT);
        }
    }
}
