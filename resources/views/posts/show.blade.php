@extends('layout.master')

@section('title', 'Post::show')

@section('content')
    <div class="w-50 mx-auto">
        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Show Post</span>
                <a href="{{ route('posts.index') }}" class="btn btn-list text-primary">Go Back</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Image</th>
                        <td>
                            @if($post->image)
                                <img src="{{ asset("storage/{$post->image}") }}" class="img-fluid" alt="{{ $post->title }}" style="max-height: 120px;">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $post->description }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($post->status == 1)
                                <span class="badge bg-primary">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Posted At</th>
                        <td>{{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endSection
