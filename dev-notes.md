# dev-notes

## 使用 Laravel Sail 建立新專案

> 詳見 [Docker Installation Using Sail](https://laravel.com/docs/10.x/installation#docker-installation-using-sail)

```sh
curl -s "https://laravel.build/company-review?with=mysql,redis,meilisearch,mailpit" | bash
```

## 安裝 `pestphp/pest`

```sh
sail composer require pestphp/pest --dev --with-all-dependencies
```

## 安裝 `pestphp/pest-plugin-laravel`

```sh
sail composer require pestphp/pest-plugin-laravel --dev
```

## 安裝 `pestphp/pest-plugin-faker`

```sh
sail composer require pestphp/pest-plugin-faker --dev
```

## 更新 npm dependencies

```sh
# 檢查更新
sail npx npm-check-updates

# 更新 package.json
sail npx npm-check-updates -u

# 安裝 dependencies 及初始化 package-lock.json
sail npm install
```
