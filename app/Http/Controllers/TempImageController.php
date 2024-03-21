<?php

namespace App\Http\Controllers;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TempImageController extends Controller
{
    public function store(Request $reqeust){
        // Apply validation
        $validator=Validator::make($reqeust->all(),[
            'image'=>'required|image'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Please Fix Error',
                'errors'=>$validator->errors()
            ]);
        }
        // Upload Image Here
       $image=$reqeust->image;
       $ext=$image->getClientOriginalExtension();
       $imageName=time().'.'.$ext;
    //    store Image info in database
    $tempImage=new TempImage();
    $tempImage->name=$imageName;
    $tempImage->save();
     
    //Move image in temp directory
    $image->move(public_path('uploads/temp'),$imageName);
    return response()->json([
        'status'=>true,
        'message'=>'Image Uploaded Successfully',
        'image'=>$tempImage
    ]);





    }
}
