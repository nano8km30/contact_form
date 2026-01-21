<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">FashionablyLate</a>
                <nav>
                    <ul class="header-nav">
                        <li class="header-nav__item">
                            <form action="{{ route('logout') }}" method="post">
                            @csrf
                                <button type="submit" class="header-nav__link">logout</button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        <div class="admin">
            <h2 class="admin__title">Admin</h2>

            <form action="{{ route('admin.search') }}" method="get" class="admin-form">
                <input class="search-form" type="text" name="name" value="{{ request('name') }}"placeholder="名前やメールアドレスを入力してください">

                <select class="select-gender" name="gender">
                    <option value="">性別</option>
                    <option value="1"{{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2"{{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3"{{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select class="select-category" name="category_id">
                    <option select-gender value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"{{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>

                <input class="select-date" type="date" name="date" value="{{ request('date') }}">

                <button class="search-btn" type="submit">検索</button>
                <a href="{{ route('admin.reset') }}" class="reset-btn">リセット</a>
            </form>
            <div class="admin-footer">
                <a href="{{ route('export') }}" class="export-btn">エクスポート</a>

                <div class="pagination">

                    @if ($contacts->onFirstPage())
                        <span class="page disabled">＜</span>
                    @else
                         <a class="page" href="{{ $contacts->previousPageUrl() }}">＜</a>
                    @endif

                    @foreach ($contacts->getUrlRange(1, min(5, $contacts->lastPage())) as $page => $url)
                        @if ($page == $contacts->currentPage())
                            <span class="page active">{{ $page }}</span>
                        @else
                            <a class="page" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($contacts->hasMorePages())
                        <a class="page" href="{{ $contacts->nextPageUrl() }}">＞</a>
                    @else
                        <span class="page disabled">＞</span>
                    @endif
                </div>
            </div>


            <table class="admin-table">
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    @php
                        $genderText = match($contact->gender) {
                            1 => '男性',
                            2 => '女性',
                            3 => 'その他', };
                    @endphp
                    <tr>
                        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                        <td>{{ $genderText }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content }}</td>
                        <td>
                            <button type="button" class="detail-btn"
                            data-id="{{ $contact->id }}"
                            data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                            data-gender="{{ $genderText }}"
                            data-email="{{ $contact->email }}"
                            data-tel="{{ $contact->tel }}"
                            data-address="{{ $contact->address }}"
                            data-building="{{ $contact->building }}"
                            data-category="{{ $contact->category->content ?? '' }}"
                            data-detail="{{ $contact->detail }}">
                            詳細</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div id="modal" class="modal hidden">
                <div class="modal-content">
                    <button id="modalClose" class="modal-close">×</button>

                    <p class="modal-label">お名前<span class="modal-span" id="modalName"></span></p>
                    <p class="modal-label">性別<span class="modal-span" id="modalGender"></span></p>
                    <p class="modal-label">メール<span class="modal-span" id="modalEmail"></span></p>
                    <p class="modal-label">電話番号<span class="modal-span" id="modalTel"></span></p>
                    <p class="modal-label">住所<span class="modal-span" id="modalAddress"></span></p>
                    <p class="modal-label">建物名<span class="modal-span" id="modalBuilding"></span></p>
                    <p class="modal-label">お問い合わせの種類<span class="modal-span" id="modalCategory_id"></span></p>
                    <p class="modal-label">お問い合わせ内容<span class="modal-span" id="modalDetail"></span></p>

                    <form id="deleteForm" method="POST" action="/delete">
                        @csrf
                        <input type="hidden" name="id" id="deleteId">
                        <button type="submit" class="delete-btn">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

<script>
document.querySelectorAll('.detail-btn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('modalName').textContent = button.dataset.name;
        document.getElementById('modalGender').textContent = button.dataset.gender;
        document.getElementById('modalEmail').textContent = button.dataset.email;
        document.getElementById('modalTel').textContent = button.dataset.tel;
        document.getElementById('modalAddress').textContent = button.dataset.address;
        document.getElementById('modalBuilding').textContent = button.dataset.building;
        document.getElementById('modalCategory_id').textContent = button.dataset.category;
        document.getElementById('modalDetail').textContent = button.dataset.detail;

        document.getElementById('deleteId').value = button.dataset.id;

        document.getElementById('modal').classList.remove('hidden');
    });
});

document.getElementById('modalClose').addEventListener('click', () => {
    document.getElementById('modal').classList.add('hidden');
});
</script>

</body>