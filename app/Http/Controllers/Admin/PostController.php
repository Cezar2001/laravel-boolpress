<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact ('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|min:5",
            "content" => "required|min:15",
            "category_id" => "nullable",
            "tags" => "nullable",
            "coverImage" => "nullable"
        ]);

        $post = new Post();
        $post->fill($data);

        $slug = Str::slug($post->title);
        $exists = Post::where("slug", $slug)->first();
        $counter = 1;
        
        while ($exists) {
            $newSlug = $slug . "-" . $counter;
            $counter++;

            $exists = Post::where("slug", $newSlug)->first();

            if (!$exists) {
                $slug = $newSlug;
            }
        }
        $post->slug = $slug;

        if(key_exists("coverImage", $data)) {
            $post->coverImage = Storage::put("images", $data["coverImage"]);
        }

        $post->save();

        if(key_exists("tags", $data)) {
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', [
            "post" => $post,
            "categories" => $categories,
            "tags" => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|max:20',
            'content' => 'required|min:10',
            "category_id" => "nullable|exists:categories,id",
            "tags" => "nullable|exists:tags,id",
            "coverImage" => "nullable"
        ]);

        $post = Post::findOrFail($id);
        $post->fill($data);

        $slug = Str::slug($post->title);
        $exists = Post::where("slug", $slug)->first();
        $counter = 1;

        while ($exists) {
            $newSlug = $slug . "-" . $counter;
            $counter++;

            $exists = Post::where("slug", $newSlug)->first();

            if (!$exists) {
                $slug = $newSlug;
            }
        }
        $post->slug = $slug;

        if(key_exists("coverImage", $data)) {

            if($post->coverImage) {
                Storage::delete($post->coverImage);
            }
            
            $post->coverImage = Storage::put("images", $data["coverImage"]);
            
            $post->save();
        }

        $post->update($data);
        
        if (key_exists("tags", $data)) {
            $post->tags()->sync($data["tags"]);
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->tags()->detach();

        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}