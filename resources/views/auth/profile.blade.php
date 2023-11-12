@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-transparent">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form class="row g-3 needs-validation" action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data" novalidate>

                        @csrf
                        @method('PUT')
                        <div class="col-md-4">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" name="name" value="{{ auth()->user()->name }}" class="@error ('name') is-invalid @enderror form-control" id="name" required>
                          <div class="valid-feedback">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-4">
                          <label for="email" class="form-label">Email</label>
                          <input type="text" value="{{ auth()->user()->email }}" name="email" class="@error ('email') is-invalid @enderror form-control" id="email" required>
                          <div class="valid-feedback">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-4">
                          <label for="profile" class="form-label">Image</label>
                          <input type="file" name="profile" class="@error ('profile') is-invalid @enderror form-control" id="profile" required>
                          <div class="valid-feedback">
                            @error('profile')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"  name="password" class="@error ('password') is-invalid @enderror form-control" id="password" required>
                            <div class="valid-feedback">
                              @error('password')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                        <div class="col-md-4">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input type="password"  name="password-confirm" class="@error ('password') is-invalid @enderror form-control" id="password-confirm"  required autocomplete="new-password">
                            <div class="valid-feedback">
                              @error('password-confirm')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>
                      
                        <div class="col-12">
                          <button class="btn btn-primary" type="submit">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection