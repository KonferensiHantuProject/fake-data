<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Traits\ResponseBuilder;
use Illuminate\Support\Facades\DB;
use Exception;

class PostController extends Controller
{
    use ResponseBuilder;

    // All Data
    public function index()
    {
        $data = Post::with('user')->get();

        return $this->success($data);
    }

    // Find One Data
    public function show(int $id)
    {
        // Find Post
        $data = Post::with('user')->find($id);
        if(!$data) return $this->error(404, null, 'Post Not Found');
        
        return $this->success($data);
    }

    // Add Data
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{

            $this->validate($request, [
                'user_id' => 'required|numeric',
                'title' => 'required',
                'content' => 'required'
            ]);

            // Prepare Data
            $post = new Post;
            $post->user_id = $request->user_id;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();

            return $this->success($post);
        }catch(Exception $e){
            DB::rollback();
            return $this->error(400, null, $e);
        }
    }

    // Update Data
    public function update(int $id, Request $request)
    {
        DB::beginTransaction();
        try{

            $this->validate($request, [
                'user_id' => 'required|numeric',
                'title' => 'required',
                'content' => 'required'
            ]);

            // Prepare Data
            $post = Post::find($id);
            if(!$post) return $this->error(404, null, 'Post Not Found');

            $post->user_id = $request->user_id;
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->content = $request->content;
            $post->save();

            return $this->success($post);
        }catch(Exception $e){
            DB::rollback();
            return $this->error(400, null, $e);
        }
    }

    // Delete Data
    public function delete(int $id)
    {
        DB::beginTransaction();
        try{
            // Prepare Data
            $post = Post::find($id);
            if(!$post) return $this->error(404, null, 'Post Not Found');

            // Delete User
            $post->delete();

            return $this->success('Post Deleted');
        }catch(Exception $e){
            DB::rollback();
            return $this->error(400, null, $e->getMessage());
        }
    }
}