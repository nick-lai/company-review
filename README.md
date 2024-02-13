# Company Review

## Installation

### 複製環境設定檔

```sh
cp ./.env.example ./.env
```

### 使用 docker 安裝 dependencies

> 詳見 [Installing Composer Dependencies for Existing Applications](https://laravel.com/docs/10.x/sail#installing-composer-dependencies-for-existing-projects)

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### 設定 `sail` 指令別名

> 非必要，但建議設定，以便直接使用 `sail` 取代冗長的 `./vendor/bin/sail` 指令

在 `~/.zshrc` 或 `~/.bashrc` 中加入以下 alias 設定，並重啟 shell

> 詳見: [Configuring A Shell Alias](https://laravel.com/docs/10.x/sail#configuring-a-shell-alias)

```sh
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

### 啟動 Laravel Sail

```sh
sail up
```

### 產生 application key

```sh
sail artisan key:generate
```

### Database migrations and seeding

```sh
sail artisan migrate:refresh --seed
```

### Install npm dependencies

```sh
sail npm clean-install
```

### Running the development server

```sh
sail npm run dev
```

## Asset bundling

> 使用 ngrok 分享開發環境時需要打包前端建構 assets

```sh
sail npm run build
```
