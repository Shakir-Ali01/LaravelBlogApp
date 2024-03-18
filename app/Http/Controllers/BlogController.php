<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
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
            'title'=>'required|min:10',
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
