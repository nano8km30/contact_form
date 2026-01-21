@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@section('title', 'お問い合わせフォーム入力ページ')

@section('content')
<div class="contact">
    <h2 class="contact__title">Contact</h2>

    <form action="/contacts/confirm" method="post" class="contact-form">
    @csrf

        <div class="form-group">
            <label class="form-label">お名前 
            <span class="required">※</span>
            </label>

            <div class="form-input">
                <input class="input__name" type="text" name="last_name" value="{{ old('last_name', isset($contact['last_name']) ? $contact['last_name'] : '') }}" placeholder="例：山田">
        
                <input class="input__name" type="text" name="first_name" value="{{ old('first_name', isset($contact['first_name']) ? $contact['first_name'] : '') }}" placeholder="例：太郎">
            </div>
        </div>
        <div class="form-error">
            <div class="name-item">
                    @error('last_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
            </div>
            <div class="name-item">
                    @error('first_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
            </div>
        </div>


        <div class="form-group">
            <label class="form-label">性別 
                <span class="required">※</span>
            </label>

            <div class="form-gender">
                <label class="gender-item">
                    <input type="radio" name="gender" value="1" {{ session('contact.gender') == 1 ? 'checked' : '' }}>
                    <span class="gender-select">男性</span>
                </label>
                <label class="gender-item">
                    <input type="radio" name="gender" value="2" {{ session('contact.gender') == 2 ? 'checked' : '' }}>
                    <span class="gender-select">女性</span>
                </label>
                <label class="gender-item">
                    <input type="radio" name="gender" value="3" {{ session('contact.gender') == 3 ? 'checked' : '' }}>
                    <span class="gender-select">その他</span>
                </label>
            </div>
        </div>
        <div class="form-error">
           @error('gender')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <label class="form-label">メールアドレス 
                <span class="required">※</span>
            </label>

            <div class="form-input">
                <input class="input-email" type="email" name="email" value="{{ old('email', isset($contact['email']) ? $contact['email'] : '') }}" placeholder="例：test@example.com">
            </div>
        </div>
        <div class="form-error">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <label class="form-label">電話番号 
                <span class="required">※</span>
            </label>

            <div class="form-input">
                <div class="form-tel">
                    <input class="input-tel" type="text" name="tel1" maxlength="4" value="{{ old('tel1', isset($contact['tel1']) ? $contact['tel1'] : '') }}" placeholder="080">
                    <span class="tel-hyphen">-</span>
                    <input class="input-tel" type="text" name="tel2" maxlength="4" value="{{ old('tel2', isset($contact['tel2']) ? $contact['tel2'] : '') }}" placeholder="1234">
                    <span class="tel-hyphen">-</span>
                    <input class="input-tel" type="text" name="tel3" maxlength="4" value="{{ old('tel3', isset($contact['tel3']) ? $contact['tel3'] : '') }}" placeholder="5678">
                </div>
            </div>
        </div>
        <div class="form-error">
            @error('tel1')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <label class="form-label">住所 
                <span class="required">※</span>
            </label>
            <input class="input-address" type="text" name="address" value="{{ old('address', isset($contact['address']) ? $contact['address'] : '') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
        </div>
        <div class="form-error">
            @error('address') 
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">建物名</label>
            <input class="input-address" type="text" name="building" value="{{ old('building', isset($contact['building']) ? $contact['building'] : '') }}" placeholder="例：○○マンション123号室">
        </div>

        <div class="form-group">
            <label class="form-label">お問い合わせの種類 
                <span class="required">※</span>
            </label>
            <div class="select-wrapper">
                <div class="form-input">
                    <select name="category_id" class="select-category">
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                            {{ old('category_id', isset($contact['category_id']) ? $contact['category_id'] : '') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-error">
            @error('category_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-group">
            <label class="form-label">お問い合わせ内容 <span class="required">※</span></label>
            <textarea class="input-text" name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', isset($contact['detail']) ? $contact['detail'] : '') }}</textarea>
        </div>
        <div class="form-error">
            @error('detail')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>


        <div class="form-button">
            <button class="input-button" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
