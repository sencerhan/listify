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
            <li class="breadcrumb-item active" aria-current="page">Kategoriler</li>
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
            <th>Kategori Adı</th>
            <th><a href="{{ route('admin.category.add') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Ekle</a></th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->details->name }}</td>
                <td><a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-warning addButton"> <i
                            class="fa fa-edit"></i></a><a
                        onclick="if(confirm('Emin misiniz?')){location.href='{{ route('admin.category.delete', $category->id) }}'}"
                        class="btn btn-danger addButton"> <i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </table>
@endsection
