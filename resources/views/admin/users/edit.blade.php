@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- CARD HEADER --}}
                    <div class="card-header d-flex"> <h3>Edit User</h3> </div>

                    {{-- CARD BODY --}}
                    <div class="card-body">
                        {{-- FORM --}}
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                            @csrf
                            @method('put')

                            {{-- NAME --}}
                            <div class="py-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter the name" value="{{ $user->name }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="py-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@email.com" value="{{ $user->email }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PHONE --}}
                            <div class="py-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter the phone" value="{{ $user->infoUser ? $user->infoUser->address : '' }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ADDRESS --}}
                            <div class="py-3">
                                <label><Address></Address></label>
                                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter the phone" value="{{ $user->infoUser ? $user->infoUser->phone : '' }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- AVATAR --}}
                            <div class="py-3">
                                <label>Avatar image</label>
                                <input type="url" name="avatar" class="form-control @error('avatar') is-invalid @enderror" placeholder="Enter the url" value="{{ $user->infoUser ? $user->infoUser->avatar : '' }}">
                                @error('avatar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <a href="{{ route('admin.home') }}" class="btn btn-outline-secondary">Annulla</a>
                                <button type="submit" class="btn btn-success">Salva modifiche</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection