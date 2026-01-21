<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">FashionablyLate</a>
                <nav>
                    <ul class="header-nav">
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/login">login</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="register">
            <h2 class="register__title">Register</h2>

            <form action="/register" method="post" class="register-form">
            @csrf

                <div class='register-content'>
                    <label class="form-label">お名前</label>
                    <div class="form-input">
                        <input class="register-input" type="text" name="name" value="{{ old('name', isset($contact['name']) ? $contact['name'] : '') }}" placeholder="例：山田　太郎">
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <label class="form-label">メールアドレス</label>
                    <div class="form-input">
                        <input class="register-input" type="text" name="email" value="{{ old('email', isset($contact['email']) ? $contact['email'] : '') }}" placeholder="例：test@example.com">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <label class="form-label">パスワード</label>
                    <div class="form-input">
                        <input class="register-input" type="text" name="password" value="{{ old('password', isset($contact['password']) ? $contact['password'] : '') }}" placeholder="例：coachtech06">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-button">
                        <button class="input-button" type="submit">登録</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
