<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class ImageController extends Controller
{
    public function index()
    {
        $images = Image::with('products')->get();
        return response()->json([
            'data' => $images
        ], Response::HTTP_OK);
    }
    public function show($id)
    {
        $image = Image::find($id);
        return response()->json([
            'data' => $image
        ], Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'product_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $product = Product::find($request->product_id);
        if($product){
            if ($request->hasFile('image')) {
                
                $imageFile      = $request->file('image');
                $fileName   = time(). '_'. $imageFile->getClientOriginalName();
            
                try {
                    $image = Image::create([
                        'name' => $fileName,
                        'file' => $fileName,
                    ]);
                    $attachImage = Image::find($image->id)->products()->attach($request->product_id);

                    $imageFile->storeAs('images/products/',$fileName);

                    $response = [
                        'message' => 'Image saved',
                        'data' => $image
                    ];
                    return response()->json($response,Response::HTTP_CREATED);
                } catch (\Exception $e) {
                    $response = [
                        'message' => 'Error : ' . $e->getMessage()
                    ];
                    return response()->json($response,Response::HTTP_CONFLICT);
                }
            }
        }
        else{
            $response = [
                'message' => 'Product Not Found',
                'data' => ''
            ];
            return response()->json($response,Response::HTTP_NOT_FOUND);
        }
    }
    public function update( Request $request, $id)
    {
        $image = Image::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($request->hasFile('image')) {
            $imageFile      = $request->file('image');
            $fileName   = time(). '_'. $imageFile->getClientOriginalName();
        
                $old_image_path = "images/products/".$image->file;
            try {
                $image->update(["name"=>$fileName,"file"=>$fileName]);
                $old_image_path = "images/products/".$image->file;                
                if(Storage::exists($old_image_path)){
                    Storage::delete($old_image_path);
                }
                $imageFile->storeAs('images/products/',$fileName);

                $response = [
                    'message' => 'Image updated',
                    'data' => $old_image_path
                ];
                return response()->json($response,Response::HTTP_CREATED);
            } catch (\Exception $e) {
                $response = [
                    'message' => 'Error : ' . $e->getMessage()
                ];
                return response()->json($response,Response::HTTP_CONFLICT);
            }
        }
    }
    public function destroy($id)
    {
        try {
            $image = Image::findOrFail($id);
            $old_image_path = "images/products/".$image->file;                
            if(Storage::exists($old_image_path)){
                Storage::delete($old_image_path);
            }
            
            $image->products()->detach();
            $image->delete($id);
            
            $response = [
                'message' => 'Image deleted',
                'data' => $image
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
