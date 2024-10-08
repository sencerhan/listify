@extends('layouts.admin')
@section('content')
    <style>
        .addButton {
            transition: transform 0.6s linear;
        }

        .addButton:hover {
            transform: scale(1.1, 1.1);
        }
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Anasayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page">İlan</li>
        </ol>
    </nav>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-border">
        <tr>
            <th>Id</th>
            <th>İlan Adı</th>
            <th><a href="{{ route('admin.ad.add') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Ekle</a></th>
        </tr>
        @foreach ($ads as $ad)
            <tr>
                <td>{{ $ad->id }}</td>
                <td>{{ $ad->details->name }}</td>
                <td>
                    <a href="{{ route('admin.ad.edit', $ad->id) }}" class="btn btn-warning addButton">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a onclick="adDelete({{ $ad->id }})" class="btn btn-danger addButton">
                        <i class="fa fa-trash">
                        </i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <script>
        var adDelete = function(id) {
            if (confirm('Emin misiniz?')) {
                location.href = '/ad/delete/' + id;

            };
        }
    </script>
@endsection
