<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //? add new product
    public function create(Request $request){
        //? form server side validation
        $validator = Validator::make(request()->all(), [

            'title' => ['required'],
            'price' => ['required'],
        ]);

        if($validator->fails()){

            return response()->json(['error' => 'Sorry! Invalid Data Provided. Title and Price is Required']);

        }else{
            $storeProduct = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'added_by' => $request->added_by,
            ]);
            
            $fullPath = "";
            $imageName = "";
            //? check if image file included or not
            if(request()->hasFile('image')){
                // Read image path, convert to base64 encoding
                $imgData = base64_encode(file_get_contents($request->file('image')));
                // get image file extension
                $fileExName = $request->file('image')->getClientOriginalExtension();
                // Format the image SRC:  data:{mime};base64,{data};
                $src = 'data: '.$fileExName.';base64,'.$imgData;
                $storeProduct->update([
                    'image' => $src,
                ]);
            }
            //? return all product after add new one
            $getAllProducts = Product::all();
            if($getAllProducts){

                return response()->json(['success' => $getAllProducts ], 200);
            }else{

                return response()->json(['error' => 'Sorry! no products available'], 200);
            }
        }
    }

    //? update or edit product
    public function updateProduct(Request $request){

        $validator = Validator::make(request()->all(), [

            'title' => ['required'],
            'price' => ['required'],
        ]);

        if($validator->fails()){

            return response()->json(['error' => 'Sorry! Invalid Data Provided. Title and Price is Required']);

        }else{
            $updateProduct = Product::find($request->id);
            if($updateProduct){

                if($request->image == "remove"){
                    $updateProduct->update([
                        'title' => $request->title,
                        'description' => $request->description,
                        'price' => $request->price,
                        'image' => '',
                        'added_by' => $request->added_by,
                    ]);
                }else{
                    $updateProduct->update([
                        'title' => $request->title,
                        'description' => $request->description,
                        'price' => $request->price,
                        'added_by' => $request->added_by,
                    ]);
                }

                $fullPath = "";
                $imageName = "";

                if(request()->hasFile('image')){
                    // Read image path, convert to base64 encoding
                    $imgData = base64_encode(file_get_contents($request->file('image')));
                    // get image file extension
                    $fileExName = $request->file('image')->getClientOriginalExtension();
                    // Format the image SRC:  data:{mime};base64,{data};
                    $src = 'data: '.$fileExName.';base64,'.$imgData;
                    $updateProduct->update([
                        'image' => $src,
                    ]);
                }
            }

            $getAllProducts = Product::all();
            if($getAllProducts){

                return response()->json(['success' => $getAllProducts], 200);
            }else{

                return response()->json(['error' => 'Sorry! no products available'], 200);
            }
            
        }
    }

    //? get all product
    public function getAllProducts(){
        $getAllProducts = Product::all();
        if($getAllProducts){

            return response()->json(['success' => $getAllProducts ], 200);
        }else{

            return response()->json(['error' => 'Sorry! no products available'], 200);
        }
    }

    //? delete product
    public function deleteProduct(Request $request){

        $getProduct = Product::find($request->id);

        if($getProduct){

            $getProduct->delete();
            
            $getAllProducts = Product::all();
            if($getAllProducts){
    
                return response()->json(['success' => $getAllProducts ], 200);
            }else{
    
                return response()->json(['error' => 'Sorry! no products available'], 200);
            }
        }else{
            return response()->json(['error' => 'Sorry! no products available'], 200);
        }

    }
}
