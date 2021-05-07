@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($posts as $post)

            <div class="col-lg-8">
                <h1 class="mt-4">{{ $post->title }}</h1>
                <p class="lead">
                    by
                    {{-- <a href="#">{{ $post->user->name }}</a> --}}
                </p>
                <hr>
                <p>Posted on {{ date('d-M-o h:i:s', strtotime($post->created_at)) }}</p>
                <p class="badge bg-primary text-white">{{ $post->category->title }}</p>
                <hr>
                <p class="lead">{{ $post->content }}</p>
                <hr>
            </div>
        @endforeach
        @if (count($posts) == 0)
            <div class="alert alert-primary" role="alert">
                Post not found please login publish and the first post ! <a href="{{ route('post.index') }}"
                    class="alert-link">Try
                    now</a>.
            </div>
        @endif
        <div class="d-flex m-3"> {{ $posts->links() }}</div>
    </div>
@endsection
