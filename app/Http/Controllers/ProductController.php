<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('categories','images')->get();
        return response()->json([
            'data' => $products
        ], Response::HTTP_OK);
    }
    public function show($id)
    {
        $product = Product::with('categories','images')->where('id',$id)->first();

        return response()->json([
            'data' => $product
        ], Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $category = Category::find($request->category_id);
        if($category)
        {
            try {
                $product = Product::create(["name"=>$request->name,"description"=>$request->description]);
                $attachProduct = Product::find($product->id)->categories()->attach($request->category_id);
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
        else{
            $response = [
                'message' => 'Category Not Found',
                'data' => ''
            ];
            return response()->json($response,Response::HTTP_NOT_FOUND);
        }
    }
    public function update( Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $product->update(["name"=>$request->name,"description"=>$request->description]);
            $product->categories()->detach();
            $product->categories()->attach($request->category_id);
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
         
            $product->categories()->detach();
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
