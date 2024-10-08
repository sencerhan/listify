@extends('layouts.admin')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="/diller">Diller</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dil Duzenle</li>
        </ol>
    </nav>


    <form action="{{ route('admin.language.update', $language->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Dil İsmi</label>
            <input value='{{old("name", $language->name)}}' name='name' type="text" class="form-control" id="name" placeholder="Dil İsmi Giriniz">
            <div style="color:red;"> @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="Icon">Bayrak Yükle</label>
            <input name='flag' type="file" class="form-control" id="Icon" placeholder="Lütfen Dil Yükleyiniz"
                accept="image/*">
            <div style="color:red;"> @error('flag')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="LanguageCode">Dil Kodu</label>
            <input value='{{old('code', $language->code)}}' name='code' type="text" class="form-control" id="LanguageCode" placeholder="Dil Kodunu Giriniz">
            <div style="color:red;"> @error('code')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-check">
            <input name="default" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" {{$language->default?"checked":""}}>
            <label class="form-check-label" for="flexCheckChecked">
                Varsayılan Yap
            </label>
            <div style="color:red;"> @error('flag')
                {{ $message }}
            @enderror
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
        <a class="btn btn-primary" id='CheckCodeButton' onclick="checkCode();">Kontrol Et</a>

    </form>

    <script>
        var checkCode;
        $(document).ready(function() {
            checkCode = function(code) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.language.checkcode') }}",
                    // The key needs to match your method's input parameter (case-sensitive).
                    data: JSON.stringify({
                        code: code,
                        _token: '{{ csrf_token() }}'
                    }),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(errMsg) {
                        alert(errMsg);
                    }
                });
            }
        });
    </script>
@endsection
