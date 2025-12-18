@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h3>Daftar Warga Menunggu Approval</h3>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>

        @foreach ($users as $u)
        <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>
                <form action="/admin/approve/{{ $u->id }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-sm">Approve</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
</div>

@endsection
