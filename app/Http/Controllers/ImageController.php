<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
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
            'name' => ['required'],
            'description' => ['required'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $image = Image::create($request->all());
            $response = [
                'message' => 'Image created',
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
    public function update( Request $request, $id)
    {
        $image = Image::findOrFail($id);

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
            $image->update($request->all());
            $response = [
                'message' => 'Image updated',
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
    public function destroy($id)
    {
        try {
            $image = Image::findOrFail($id);
         
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
