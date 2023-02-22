<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class CategoryProductController extends Controller
{
    public function index()
    {
        $CategoryProducts = CategoryProduct::all();
        return response()->json([
            'data' => $CategoryProducts
        ], Response::HTTP_OK);
    }
    public function show($id)
    {
        $CategoryProduct = CategoryProduct::select('categories.*')
        ->join('categories', 'categories.id', '=', 'category_products.category_id')
        ->where('product_id',$id)->get();
        if(count($CategoryProduct) > 0){
            return response()->json([
                'data' => $CategoryProduct
            ], Response::HTTP_OK);
        }
        else{
            return response()->json([
                'message' => 'Data Not Found',
                'data' => ''
            ], Response::HTTP_NOT_FOUND);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required'],
            'category_id' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $categoryProduct = CategoryProduct::create($request->all());
            $response = [
                'message' => 'Category Product created',
                'data' => $categoryProduct
            ];
            return response()->json($response,Response::HTTP_CREATED);
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
            $categoryProduct = CategoryProduct::where('product_id',$id);
            $data = $categoryProduct->first();
         if($data){
                $categoryProduct->delete();
                $response = [
                    'message' => 'Category Product deleted',
                    'data' => $data
                ];
                return response()->json($response,Response::HTTP_OK);
            }
            else{
                $response = [
                    'message' => 'Data Not Found',
                    'data' => $data
                ];
                return response()->json($response,Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            $response = [
                'message' => 'Error : ' . $e->getMessage()
            ];
            return response()->json($response,Response::HTTP_CONFLICT);
        }
    }
}
