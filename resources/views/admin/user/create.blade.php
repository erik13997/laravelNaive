@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <divc class="mb-3">
            <h4>Create Users</h4>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 needs-validation" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" novalidate>

                        @csrf
                        <div class="col-md-4">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" name="name" class="@error ('name') is-invalid @enderror form-control" id="name" required>
                          <div class="valid-feedback">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-4">
                          <label for="email" class="form-label">Email</label>
                          <input type="email"  name="email" class="@error ('email') is-invalid @enderror form-control" id="email" required>
                          <div class="valid-feedback">
                            @error('email')
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
                        <div class="col-12">
                          <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection