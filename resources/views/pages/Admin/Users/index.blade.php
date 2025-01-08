@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12 col-xl-12">
                @if (session()->has('eror'))
                    <div class="alert alert-danger">
                        {{ session('eror') }}
                    </div>
                @endif
                @if (session()->has('sukses'))
                    <div class="alert alert-success">
                        {{ session('sukses') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                        @if ($filter === 'User')
                            Panel Pengguna
                        @elseif ($filter === 'Admin')
                            Panel Administrator
                        @else
                            Panel Administrator
                        @endif
                        </h4>
                        <p>
                        @if ($filter === 'User')
                            Klik Admin untuk Ganti
                        @elseif ($filter === 'Admin')
                            Klik User untuk Ganti
                        @else
                            Klik User untuk Ganti
                        @endif
                        </p>
                        <div class="card-tools">
                            <a href="{{ route('users.create') }}" name="tambah" id="tambah"
                                class="btn btn-sm btn-primary">Tambah</a>
                                @if ($filter === 'User')
                                    <a href="{{ route('users.index', ['filter' => 'Admin']) }}" class="btn btn-sm btn-secondary">Admin</a>
                                @elseif ($filter === 'Admin')
                                    <a href="{{ route('users.index', ['filter' => 'User']) }}" class="btn btn-sm btn-secondary">User</a>
                                @else
                                    <a href="{{ route('users.index', ['filter' => 'User']) }}" class="btn btn-sm btn-secondary">User</a>
                                @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><img src="{{ $item->user_image != '-' ? asset('storage/' . $item->user_image) : asset('/') . 'assets/compiled/jpg/5.jpg' }}"
                                                    class="img my-2" width="100" id="view-img"></td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->user_phone }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>
                                                <form action="{{ route('users.destroy', $item->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a href="{{ route('users.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <button type="submit" class="btn btn-sm btn-danger form-confirm">Delete</button>
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
    </section>
@endsection
