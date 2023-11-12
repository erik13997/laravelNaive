@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="row justify-content-center">
        <divc class="mb-3">
            <h4>Create Student</h4>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3 needs-validation" action="{{ route('student.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="col-md-6">
                          <label for="nama" class="form-label">Nama</label>
                          <input type="text" name="nama" value="{{ old('nama') }}" class="@error ('nama') is-invalid @enderror form-control" id="nama" required>
                          <div class="valid-feedback">
                            @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>

                        <div class="col-md-6">
                            <label for="npm" class="form-label">Npm</label>
                            <input type="text" name="npm" value="{{ old('npm') }}" class="@error ('npm') is-invalid @enderror form-control" id="npm" required>
                            <div class="valid-feedback">
                              @error('npm')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-2">
                            <label for="ips1" class="form-label">Ip semester 1</label>
                            <input type="text" name="ips1" value="{{ old('ips1') }}" class="@error ('ips1') is-invalid @enderror form-control" id="ips1" required>
                            <div class="valid-feedback">
                              @error('ips1')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-2">
                            <label for="ips2" class="form-label">Ip semester 2</label>
                            <input type="text" name="ips2" class="@error ('ips2') is-invalid @enderror form-control" id="ips2" required>
                            <div class="valid-feedback">
                              @error('ips2')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-2">
                            <label for="ips3" class="form-label">Ip semester 3</label>
                            <input type="text" name="ips3" class="@error ('ips3') is-invalid @enderror form-control" id="ips3" required>
                            <div class="valid-feedback">
                              @error('ips3')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-2">
                            <label for="ips4" class="form-label">Ip semester 4</label>
                            <input type="text" name="ips4" class="@error ('ips4') is-invalid @enderror form-control" id="ips4" required>
                            <div class="valid-feedback">
                              @error('ips4')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          <div class="col-md-4">
                            <label for="ips5" class="form-label">Ip semester 5</label>
                            <input type="text" name="ips5" class="@error ('ips5') is-invalid @enderror form-control" id="ips5" required>
                            <div class="valid-feedback">
                              @error('ips5')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                            </div>
                          </div>

                          <span class="mb-2">Status</span>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">Tepat Waktu</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="0">
                            <label class="form-check-label" for="inlineRadio2">Tidak Tepat Waktu</label>
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