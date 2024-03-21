<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Blog;
use App\Models\TempImage;
class BlogController extends Controller
{
    // This method will return all blog
    public function index(){     
    }
    // This method will return a single blog
    public function show(){
         return "hello";
    }
    // this method is will store a blog
    public function store(Request $request)
    {
       $validator=Validator::make($request->all(),[
            'title'=>'required|min:3',
            'author'=>'required|min:3'
        ]);
      if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Please fix the error',
                'errors'=>$validator->errors()
            ]);
      }
      $blog = new Blog();
      $blog->title = $request->title;
      $blog->author = $request->author;
      $blog->description = $request->description;
      $blog->shotDesc = $request->shortDesc;
      $blog->save();
  
    //    Save Image Here
        $tempImage=TempImage::find($request->image_id);//Getting image name from tempImage table using imageId (which is insert in database at athe time of select image(at onChange))
        if($tempImage != null){
            //convert image name into array at behalf of .
            $imageExtArray=explode('.',$tempImage->name);
            // Get last value of array which will be extention of image
            $ext=last($imageExtArray);
            $imageName=time().'-'.$blog->id.'.'.$ext;

            $blog->image=$imageName;
            //save imageName Into blog Table
            $blog->save();
            //get image from temp folder which store at the time of onchange file field 
            $sourcePath=public_path('uploads/temp/'.$tempImage->name);
            $destPath=public_path('uploads/blogs/'.$imageName);
            File::copy($sourcePath,$destPath);
        }
      return response()->json([
        'status'=>true,
        'message'=>'Blog added successfully',
        'data'=>$blog
    ]);
    }
    // this method will update a blog
    public function update(){
    }
   public function destroy(){
   }
}
