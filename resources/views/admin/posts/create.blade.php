@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- CARD HEADER --}}
                    <div class="card-header d-flex"> <h3>Add a new Post</h3> </div>

                    {{-- CARD BODY --}}
                    <div class="card-body">
                        {{-- FORM --}}
                        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            {{-- TITLE --}}
                            <div class="py-3">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter the title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- POST CONTENT --}}
                            <div class="py-3">
                                <label>Content</label>
                                <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Write something..." required> {{ old('content') }} </textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- UPLOAD IMAGE --}}
                            <div class="py-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- IMAGE LINK --}}
                            <div class="py-3">
                                <label>Image Link</label>
                                <input type="url" name="imageLink" class="form-control @error('imageLink') is-invalid @enderror" placeholder="Enter the url" value="{{ old('imageLink') }}">
                                @error('imageLink')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SELECT CATEGORY --}}
                            <div class="py-3">
                                <label>Category</label>
                                <select name="category_id" class="form-select" id="category_id">
                                    <option value="">-- Nessuna categoria --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- SELECT TAG --}}
                            <div class="py-3">
                                <label>Tags</label>
                                <br>
                                @foreach ($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="tag_{{ $tag->id }}" value="{{ $tag->id }}" name="tags[]">
                                        <label class="form-check-label" for="tag_{{ $tag->id }}">{{ Ucwords($tag->name) }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Annulla</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection