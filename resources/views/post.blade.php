@extends('layouts.app')
@section('content')

    <div class="container-md">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5>All Post</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($posts as $post)
                            <div class="list-group">
                                <a class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $post->title }}</h5>
                                        <small>{{ date('d-M-o h:i:s', strtotime($post->created_at)) }}</small>
                                    </div>
                                    <p class="mb-1 ellipsis div-list">{{ $post->content }}</p>
                                    <div class="d-flex mt-2">
                                        <form action="{{ route('post.edit', $post->id) }}" style="z-index: 100">
                                            <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                        </form>

                                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger ml-1">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        @if (count($posts) === 0)
                            <div class="alert alert-primary" role="alert">
                                You 've never published your post yet
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header d-flex align-item-center">
                        <h5>
                            @if (!empty($edit))
                                Update
                            @else
                                Upload new
                            @endif
                            post
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ !empty($ipost) ? route('post.update', $ipost->id) : route('post.store') }}"
                            method="POST">
                            @if (!empty($ipost))
                                @method('PUT')
                            @else
                                @method('POST')
                            @endif
                            @csrf
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <label for="title" class="label-control">Title</label>
                            <textarea type="text" id="title" class="form-control" name="title"
                                required>{{ !empty($ipost) ? $ipost->title : '' }}</textarea>
                            <label for="content" class="label-control">Content</label>
                            <textarea name="content" class="form-control" id="content" cols="30" rows="5"
                                required>{{ !empty($ipost) ? $ipost->content : '' }}</textarea>
                            <label for="categories">Categoies</label>
                            <select class="form-control" id="categories" name="category_id" required>
                                <option value="">----Choose categories----</option>
                                @foreach ($categories as $category)
                                    @if (!empty($ipost))
                                        @if ($ipost->category->title === $category->title)
                                            <option value="{{ $category->id }}" selected>{{ $category->title }}
                                            </option>
                                        @else
                                            <option value="{{ $category->id }}">
                                                {{ $category->title }}
                                            </option>
                                        @endif
                                    @else
                                        <option value="{{ $category->id }}">
                                            {{ $category->title }}
                                        </option>
                                    @endif

                                @endforeach
                            </select>
                            @if (!empty($ipost))
                                <input type="submit" class="btn btn-primary mt-2" value="Update">
                                <a href="{{ route('post.index') }}" class="btn btn-secondary mt-2"> Back</a>
                            @else
                                <input type="submit" class="btn btn-primary mt-2" value="Add">
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
