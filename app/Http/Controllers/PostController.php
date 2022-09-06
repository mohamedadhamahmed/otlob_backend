<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseTrait;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use Validator;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponseTrait;
    public function index()
    {
        //

        $posts=PostResource::collection(Post::get());

        return $this->apiResponse($posts,'done',200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        return 'create';
   

    }

    /**
     * Store a newly created resource in storage.
     *@param  \Illuminate\Validation\Validator
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request  $request)
    {
      
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
 
     
    
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
           
        ]);
        $post_resource=new PostResource( $post);
        return $this->apiResponse($post_resource,'post created',200);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        //
        $post=Post::find($id);
        if($post){
            $post_resource=new PostResource( $post);
            return $this->apiResponse($post_resource,'post  found',200);

        }
      
            return $this->apiResponse($post,'post not found',404);

     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        $post=Post::find($id);    
if($post){

    $post->update($request->all());
    $post_resource=new PostResource( $post);

    return $this->apiResponse($post_resource,'post  found',200);
}

return $this->apiResponse($null,'post not found',404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        
        $post=Post::find($id); 
         
        if($post){
        
            $post->delete();
            
        
            return $this->apiResponse(null,'post  deleted',200);
        }
        
        return $this->apiResponse(null,'post not found',404);
    }
}
