@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="mb-3">
               <h4>Hasil prediksi anda</h4>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-transparent">{{ __('Table prediksi') }}</div>

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
                            <th scope="col">Ipk</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($predictions as $prediction)
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $prediction->nama }}</td>
                            <td>{{ $prediction->npm }}</td>
                            <td>{{ $prediction->ips1 }}</td>
                            <td>{{ $prediction->ips2 }}</td>
                            <td>{{ $prediction->ips3 }}</td>
                            <td>{{ $prediction->ips4 }}</td>
                            <td>{{ $prediction->ips5 }}</td>
                            <td>{{ $prediction->ipk }}</td>
                            <td>
                                @if ($prediction->status_kelulusan === 1)
                                <span class="badge text-bg-warning">Tepat Waktu</span>
                                @else
                                <span class="badge text-bg-danger">Tidak Tepat Waktu</span>
                                @endif
                            </td>
                            <td>
                                <form style="display: inline-block" action="{{ route('prediction.destroy', $prediction->id) }}" method="POST">
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
        </div>
    </div>
</div>
@endsection
