<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreateRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index() {

        $posts = Post::paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store(CreateRequest $request) {

        $title = $request->title;
        $description = $request->description;

        // ==== using raw query
        // DB::insert("INSERT INTO posts (`title`, `description`, `user_id`) VALUE(?, ?, ?)", [$title, $description, 1]);

        // ==== Using Active Query
        // DB::table('posts')->insert([
        //     'title' => $title,
        //     'description' => $description,
        //     'user_id' => $user_id
        // ]);

        $fileNameWithPath = '';

        if($file = $request->image) {

            $extension = $file->getClientOriginalExtension();

            $fileName = time() . "_".rand(11111,99999). "." . $extension;

            $fileNameWithPath = Storage::disk('public')->putFileAs("uploads/images/", $file, $fileName);
        }

        Post::create([
            'title' => $title,
            'description' => $description,
            'image' => $fileNameWithPath
        ]);

        session()->flash('success-message', 'Post has been saved successfully!');

        // return back();

        return to_route('posts.index');

    }

    public function show($id) {

        $post = Post::find($id);

        if(! $post) {
            abort('404', 'We could not found the record!');
        }

        return view('posts.show', ["post" => $post]);
    }

    public function edit($id) {

        $post = Post::find($id);

        if(! $post) {
            abort('404', 'We could not found the record!');
        }

        return view('posts.edit', ["post" => $post]);
    }

    public function update(UpdateRequest $request, $id) {

        $post = Post::find($id);

        if(! $post) {
            abort('404', 'We could not found the record!');
        }

        $title = $request->title;
        $description = $request->description;
        $status = $request->status;

        $update = [
            'title' => $title,
            'description' => $description,
            'status' => $status,
        ];

        if ($file = $request->image) {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . "_".rand(11111,99999). "." . $extension;

            $fileNameWithPath = Storage::disk('public')->putFileAs("uploads/images/", $file, $fileName);
            $update['image'] = $fileNameWithPath;

            if($post->image) {
                Storage::disk('public')->delete($post->image);
            }
        }

        $post->update($update);

        session()->flash('success-message', 'Post updated successfully!');

        return to_route('posts.index');
    }

    public function destroy($id) {

        $post = Post::find($id);

        if (! $post) {
            abort('404', 'We could not found the record!');
        }

        if($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        session()->flash('success-message', 'We have successfully removed the post.');

        return to_route('posts.index');

    }
}
