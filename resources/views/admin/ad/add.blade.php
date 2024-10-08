@extends('layouts.admin')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Anasayfa</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.ad.index') }}">İlanlar</a></li>
            <li class="breadcrumb-item active" aria-current="page">İlan Ekle</li>
        </ol>
    </nav>


    <form action="{{ route('admin.ad.insert') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-bottom: 10px">
            <label for="name" style="margin-bottom: 0;">İlan İsmi</label>
            @foreach ($languages as $language)
                <div style="display:flex; align-items: center">
                    <div style="margin-right: 5px">
                        <img src="{{ $language->flag }}" style="width: 50px" />
                    </div>
                    <div style="flex: 1;">
                        <input value='{{ old('name.' . $language->id) }}' name='name[{{ $language->id }}]' type="text"
                            class="form-control" id='name[{{ $language->id }}]'
                            placeholder="İlan ismi giriniz ({{ $language->name }})"
                            onkeyup="$('#slug{{ $language->id }}').val(slugger(this.value))">
                    </div>
                </div>
                <div style="color:red;"> @error('name.' . $language->id)
                        {{ $message }}
                    @enderror
                </div>
            @endforeach
        </div>

        <div class="form-group" style="margin-bottom: 10px">
            <label for="meta_title" style="margin-bottom: 0;">Meta Başlık Giriniz</label>
            @foreach ($languages as $language)
                <div style="display:flex; align-items: center">
                    <div style="margin-right: 5px">
                        <img src="{{ $language->flag }}" style="width: 50px" />
                    </div>
                    <div style="flex: 1;">
                        <input value='{{ old('meta_title.' . $language->id) }}' name='meta_title[{{ $language->id }}]' type="text"
                            class="form-control" id='meta_title[{{ $language->id }}]'
                            placeholder="Meta Başlık giriniz ({{ $language->name }})">
                    </div>
                </div>
                <div style="color:red;"> @error('meta_title.' . $language->id)
                        {{ $message }}
                    @enderror
                </div>
            @endforeach
        </div>
        <div class="form-group" style="margin-bottom: 10px">
            <label for="meta_description" style="margin-bottom: 0;">Meta Açıklama</label>
            @foreach ($languages as $language)
                <div style="display:flex; align-items: center">
                    <div style="margin-right: 5px">
                        <img src="{{ $language->flag }}" style="width: 50px" />
                    </div>
                    <div style="flex: 1;">
                        <input value='{{ old('meta_description.' . $language->id) }}' name='meta_description[{{ $language->id }}]'
                            type="text" class="form-control" id='meta_description{{ $language->id }}'
                            placeholder="Meta açıklama giriniz ({{ $language->name }})">
                    </div>
                </div>
                <div style="color:red;"> @error('meta_description.' . $language->id)
                        {{ $message }}
                    @enderror
                </div>
            @endforeach
        </div>
        <div class="form-group" style="margin-bottom: 10px">
            <label for="meta_keywords" style="margin-bottom: 0;">Anahtar Kelimeler</label>
            @foreach ($languages as $language)
                <div style="display:flex; align-items: center">
                    <div style="margin-right: 5px">
                        <img src="{{ $language->flag }}" style="width: 50px" />
                    </div>
                    <div style="flex: 1;">
                        <input value='{{ old('meta_keywords.' . $language->id) }}' name='meta_keywords[{{ $language->id }}]' type="text"
                            class="form-control" id='meta_keywords[{{ $language->id }}]'
                            placeholder="Meta anahtar kelimeler ({{ $language->name }}) (virgülle ayrınız)">
                    </div>
                </div>

                <div style="color:red;"> @error('meta_keywords.' . $language->id)
                        {{ $message }}
                    @enderror
                </div>
            @endforeach
        </div>
        <div class="form-group" style="margin-bottom: 10px">
            <label for="slug" style="margin-bottom: 0;">Slug ({{ $language->name }})</label>
            @foreach ($languages as $language)
                <div style="display:flex; align-items: center">
                    <div style="margin-right: 5px">
                        <img src="{{ $language->flag }}" style="width: 50px" />
                    </div>
                    <div style="flex: 1;">
                        <input value='{{ old('slug.' . $language->id) }}' name='slug[{{ $language->id }}]' type="text"
                            class="form-control" id='slug{{ $language->id }}' placeholder="({{ $language->name }})"
                            required>
                    </div>
                </div>
                <div style="color:red;"> @error('slug.' . $language->id)
                        {{ $message }}
                    @enderror
                </div>
            @endforeach
        </div>
        <div class="form-group" style="margin-bottom: 10px">
            <label for="sort_order" style="margin-bottom: 0;">Sıralama</label>
            <input value='{{ old('sort_order') }}' name='sort_order' type="text" class="form-control" id='sort_order'
                placeholder="Sıralama">
            <div style="color:red;"> @error('sort_order')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group" style="margin-bottom: 10px">
            <label for="Üst Kategori" style="margin-bottom: 0;">Üst Kategori</label>
            <select name="category_ids[]" class="select2" style="width: 100%" multiple>
                <option value="">Kategori Seç</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{ $category->details->name }}</option>
                @endforeach
            </select>
            <div style="color:red;"> @error('parent_ids[]')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form-group" style="margin-bottom: 10px">
            <center>
                <h4 style="margin-bottom: 0;"> Kategori İçeriği</h4>
            </center>
            @foreach ($languages as $language)
                <div style="display:flex; align-items: center">
                    <div style="margin-right: 5px">
                        <img src="{{ $language->flag }}" style="width: 50px" />
                    </div>
                    <div style="flex: 1;">
                        <textarea value='{{ old('description.' . $language->id) }}' name='description[{{ $language->id }}]'
                            id='content{{ $language->id }}'>
                        </textarea>
                    </div>
                </div>

                <div style="color:red;"> @error('description.' . $language->id)
                        {{ $message }}
                    @enderror
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Kaydet</button>
    </form>

    <script>
        function slugger(text) {
            const characterMap = {
                'Ç': 'C',
                'ç': 'c',
                'Ğ': 'G',
                'ğ': 'g',
                'İ': 'I',
                'ı': 'i',
                'Ö': 'O',
                'ö': 'o',
                'Ş': 'S',
                'ş': 's',
                'Ü': 'U',
                'ü': 'u'
            };

            return text
                .toString() // Metni string'e çevirir
                .normalize('NFD') // Unicode normalization, aksanları ayırır
                .replace(/[\u0300-\u036f]/g, '') // Aksanlı karakterleri siler
                .replace(/./g, char => characterMap[char] ||
                    char) // Türkçe karakterleri İngilizce karşılıklarıyla değiştirir
                .toLowerCase() // Tüm harfleri küçük yapar
                .trim() // Başındaki ve sonundaki boşlukları siler
                .replace(/[^a-z0-9\s-]/g, '') // Özel karakterleri temizler
                .replace(/\s+/g, '-') // Birden fazla boşluğu tek bir tire ile değiştirir
                .replace(/-+/g, '-'); // Birden fazla tiri tek bir tire ile değiştirir
        }
    </script>
@endsection
