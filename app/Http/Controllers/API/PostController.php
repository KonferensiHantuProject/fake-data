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
        $data = Post::all();

        return $this->success($data);
    }

    // Find One Data
    public function show(int $id)
    {
        // Find Post
        $data = Post::find($id);
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

}