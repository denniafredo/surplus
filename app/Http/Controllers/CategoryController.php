<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        return response()->json([
            'data' => $categories
        ], Response::HTTP_OK);
    }
    public function show($id)
    {
        $category = Category::with('products')->where('id',$id)->first();
        return response()->json([
            'data' => $category
        ], Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $category = Category::create($request->all());
            $response = [
                'message' => 'Category created',
                'data' => $category
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
        $Category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $Category->update($request->all());
            $response = [
                'message' => 'Category updated',
                'data' => $Category
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
            $category = Category::findOrFail($id);
         
            $category->products()->detach();
            $category->delete($id);
            $response = [
                'message' => 'Category deleted',
                'data' => $category
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
