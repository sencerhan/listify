@extends('layouts.admin')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.language.index')}}">Anasayfa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Diller</li>
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
            <th style="width: 75px">Bayrak</th>
            <th>Id</th>
            <th>Dil Adı</th>
            <th><a href="{{route("admin.language.add")}}" class="btn btn-primary" ><i class="fa fa-plus"></i>Ekle</a></th>
        </tr>
        @foreach ($languages as $language)
            <tr>
                <td><img src="{{ $language->flag}}" style="width: 50px"/></td>
                <td>{{ $language->id }}</td>
                <td>{{ $language->name }}</td>
                <td><a href="{{ route('admin.language.edit', $language->id) }}" class="btn btn-warning"> <i class="fa fa-edit"></i></a><a href="{{ route('admin.language.delete', $language->id) }}" class="btn btn-danger"> <i class="fa fa-trash"></i></a></td>
            </tr>
        @endforeach
    </table>
@endsection
