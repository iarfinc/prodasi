@extends('layouts.app')
@section('content')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Tema Aktif</h6>
                                <h6 class="font-extrabold mb-0">{{ $tema_aktif->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Kehadiran</h6>
                                <h6 class="font-extrabold mb-0">{{ $absensi->count() }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{ auth()->user()->user_image != '-' ? asset('storage/' . auth()->user()->user_image) : asset('/') . 'assets/compiled/jpg/5.jpg' }}">
                        </div>
                        <div class="ms-2 name">
                            <p class="font-bold py-0 my-0">{{auth()->user()->name}}</p>
                            <small class="text-muted mb-0">{{auth()->user()->role}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kehadiran</h3>
                    <p class="card-subtitle">Tabel Absensi Kegiatan</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg" id="">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tema</th>
                                    <th>Status</th>
                                    <th>Tanggal Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration}} </td>
                                        <td>{{ $item->tema->nama_tema}}</td>
                                        <td>{{ $item->status}}</td>
                                        <td>{{ $item->tanggal_absensi}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
