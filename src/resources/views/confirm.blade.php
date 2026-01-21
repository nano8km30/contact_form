@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@section('title', 'お問い合わせフォーム確認ページ')

@section('content')
<div class="confirm">
    <h2 class="confirm__title">Confirm</h2>

    <form action="/thanks" method="post" class="confirm-form">
    @csrf

        <div class="form-group">
            <label class="form-label">お名前</label>
            <div class="form-input">
                <p>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">性別</label>
            <div class="form-input">
                <p>
                    @if($contact['gender'] == 1) 男性
                    @elseif($contact['gender'] == 2) 女性
                    @else その他
                    @endif
                </p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">メールアドレス</label>
            <div class="form-input">
                <p>{{ $contact['email'] }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">電話番号</label>
            <div class="form-input">
                <p>{{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">住所</label>
            <div class="form-input">
                <p>{{ $contact['address'] }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">建物名</label>
            <div class="form-input">
                <p>{{ $contact['building'] }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">お問い合わせの種類</label>
            <div class="form-input">
                <p>{{ $contact['category_name'] }}</p> 
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">お問い合わせ内容</label>
            <div class="form-input">
                <p>{{ $contact['detail'] }}</p>
            </div>
        </div>

        <div class="form-button">
            <button class="input-button" type="submit">送信</button>
            <a href="/" class="input-link">修正</a>
        </div>

    </form>
</div>
@endsection