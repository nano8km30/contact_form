# お問い合わせ管理アプリ

Laravel を用いて作成したお問い合わせ管理アプリケーションです。  
ユーザーからのお問い合わせを登録し、管理画面から一覧・確認ができます。

---

## 使用技術

- PHP 8.x
- Laravel 8.x
- Laravel Fortify（ユーザー認証）
- MySQL （MariaDB 11.8 で動作確認）
- Docker / docker-compose
- Composer

---

## Docker ビルド

git clone https://github.com/nano8km30/contact_form.git
cd  contact_form

## Laravel 環境構築

docker-compose up -d --build
docker-compose exec php bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed

## 開発環境

・お問い合わせ画面:http://localhost/
・登録画面:http://localhost/register
・管理画面:http://localhost/admin

## ER 図

![ER図](images/contact.drawio.png)
