<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">FashionablyLate</a>
                <nav>
                    <ul class="header-nav">
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/register">register</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="login">
            <h2 class="login__title">Login</h2>

            <form action="/login" method="post" class="login-form">
            @csrf

                <div class='login-content'>
                    <label class="form-label">メールアドレス</label>
                    <div class="form-input">
                        <input class="login-input" type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <label class="form-label">パスワード</label>
                    <div class="form-input">
                        <input class="login-input" type="password" name="password" placeholder="例：coachtech06">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-button">
                        <button class="input-button" type="submit">ログイン</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
