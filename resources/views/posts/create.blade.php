@extends('layout.master')

@section('title', 'Post::create')

@section('content')
    <div class="w-50 mx-auto">
        <div class="card mt-5">
            <div class="card-header">
                Create Post
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

                @if (session('alert-success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Good Job!</strong> {{ session()->get('alert-success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">

                    @csrf

                    {{-- <input type="hidden" name="csrf_token" value="{{ csrf_token() }}"> --}}

                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter post title"
                            value="{{ old('title') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" placeholder="Description  here ...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endSection
