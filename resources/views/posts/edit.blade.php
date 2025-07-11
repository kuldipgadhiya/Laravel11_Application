@extends('layout.master')

@section('title', 'Post::edit')

@section('content')
    <div class="w-50 mx-auto">
        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit Post</span>
                <a href="{{ route('posts.index') }}" class="btn btn-list text-primary">Go Back</a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endForeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">

                    @csrf

                    @method('PATCH')

                    {{-- <input type="hidden" name="csrf_token" value="{{ csrf_token() }}"> --}}

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter post title"
                            value="{{ old('title', $post->title) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" placeholder="Description  here ...">{{ old('description', $post->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <div>
                            @if($post->image)
                                <img src="{{ asset("storage/{$post->image}") }}" class="img-fluid" alt="{{ $post->title }}" style="max-height: 120px;">
                            @endif
                        </div>
                        <label class="form-label">Image</label>
                        <input name="image" type="file" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option selected value="" disabled>Select Option</option>
                            <option @selected($post->status == 1) value="1" >Publish</option>
                            <option @selected($post->status == 0) value="0" >Draft</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

@endSection
