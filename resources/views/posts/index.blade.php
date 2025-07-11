@extends('layout.master')

@section('title', 'Post')

@section('css')
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@endsection

@section('content')
    <div class="w-75 mx-auto pt-5">
        @if (session('success-message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Good Job!</strong> {{ session()->get('success-message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Posts</span>
                <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">Create Post</a>
            </div>
            <div class="card-body">
                @if ($posts->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $number = 1;
                                if (request()->has('page') && request()->get('page') > 1) {
                                    $number = (request()->get('page') - 1) * 10 + 1;
                                }
                            @endphp

                            @foreach ($posts as $post)
                                <tr>
                                    <th>{{ $number }}</th>
                                    <td>
                                        @if($post->image)
                                            <img src="{{ asset("storage/{$post->image}") }}" class="img-fluid" alt="{{ $post->title }}">
                                        @endif
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->description }}</td>
                                    <td>
                                        @if ($post->status == 1)
                                            <span class="badge bg-primary">Published</span>
                                        @else
                                            <span class="badge bg-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td class="">
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                                                class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                                class="btn btn-primary btn-sm"><i class="fa-solid fa-edit"></i></a>
                                            <form method="POST"
                                                action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                onsubmit="return confirm('Are you sure to delete this records?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                @php
                                    $number++;
                                @endphp
                            @endforeach
                        </tbody>

                    </table>
                @else
                    <h6 class="text-warning text-center">No posts found!</h6>
                @endif

            </div>

            @if ($posts->total() > 10)
                <div class="card-footer">
                    <td colspan="5">
                        {{ $posts->links() }}
                    </td>
                </div>
            @endif

        </div>
    </div>

@endSection
