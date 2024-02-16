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

## 安裝 Tailwind CSS 並初始化設定檔

```sh
# 安裝 Tailwind CSS
sail npm install -D tailwindcss postcss autoprefixer

# 初始化 Tailwind CSS 設定檔
sail npx tailwindcss init -p
```

## 建立 Company model, migration, factory, seeder, policy, API controller, resource 與 Pest tests

```sh
# 建立 Company model, migration, factory, seeder, policy, Pest test
sail artisan make:model Company -mfs --policy --pest
# 建立 Company API controller, Pest test
sail artisan make:controller Api/CompanyController --api --model=Company --pest
# 建立 Company resource
sail artisan make:resource CompanyResource
```

## 建立 User seeder, API controller, resource 與 Pest tests

```sh
# 建立 User seeder
sail artisan make:seeder UserSeeder
# 建立 User API controller, Pest test
sail artisan make:controller Api/UserController --api --model=User --pest
# 建立 User resource
sail artisan make:resource UserResource
```

## 建立 Review model, migration, factory, seeder, policy, API controller, resource 與 Pest tests

```sh
# 建立 Review model, migration, factory, seeder, policy, Pest test
sail artisan make:model Review -mfs --policy --pest
# 建立 Review API controller, Pest test
sail artisan make:controller Api/CompanyReviewController --api --model=Review --parent=Company --pest
sail artisan make:controller Api/UserReviewController --api --model=Review --parent=User --pest
sail artisan make:controller Api/ReviewController --api --model=Review --pest
# 建立 Review resource
sail artisan make:resource ReviewResource
```

## 重新執行所有 database migrations 並產生假資料

```sh
sail artisan migrate:refresh --seed
```

## 身分認證

```sh
sail artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
sail artisan make:controller Api/AuthController
```

## 建立 CompanyController, CompanyReviewController

```sh
sail artisan make:controller CompanyController --resource --model=Company --pest
sail artisan make:controller CompanyReviewController --resource --model=Review --parent=Company --pest
```

## 建立 StartRating component

```sh
sail artisan make:component StartRating --pest
```

## 安裝 `@iconify/tailwind` 與 `@iconify-json/ion`

```sh
sail npm install --save-dev @iconify/tailwind
sail npm install --save-dev @iconify-json/ion
```
