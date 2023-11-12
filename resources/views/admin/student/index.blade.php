@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="mb-3">
               <a href="{{ route('student.create') }}" class="btn btn-sm btn-primary">New Student</a>
            </div>
            <div class="card shadow-md">
                <div class="card-header bg-transparent">{{ __('Student Table') }}</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Npm</th>
                            <th scope="col">Ips1</th>
                            <th scope="col">Ips2</th>
                            <th scope="col">Ips3</th>
                            <th scope="col">Ips4</th>
                            <th scope="col">Ips5</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($students as $student)
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $student->nama }}</td>
                            <td>{{ $student->npm }}</td>
                            <td>{{ $student->ips1 }}</td>
                            <td>{{ $student->ips2 }}</td>
                            <td>{{ $student->ips3 }}</td>
                            <td>{{ $student->ips4 }}</td>
                            <td>{{ $student->ips5 }}</td>
                            <td>
                                @if ($student->status === 1)
                                <span class="badge text-bg-warning">Tepat Waktu</span>
                                @else
                                <span class="badge text-bg-danger">Tidak Tepat Waktu</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('student.edit',$student->id) }}" class="btn btn-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <form style="display: inline-block" action="{{ route('student.destroy', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="my-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
