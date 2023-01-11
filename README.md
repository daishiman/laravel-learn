# initial-setting-laravel(docker 🐳)

<img src="https://user-images.githubusercontent.com/35098175/145682384-0f531ede-96e0-44c3-a35e-32494bd9af42.png" alt="docker-laravel">

## Introduction

Build a simple laravel development environment with docker-compose. Compatible with Windows(WSL2), macOS(M1) and Linux.

## 使用方法

ビルドする
下記のコマンドだけで使えるようになります。

```zsh:
make init
```

http://localhost

## 参考

- Read this [Makefile](https://github.com/daishiman/initial-setting-laravel/blob/main/Makefile).
- Read this [Wiki](https://github.com/daishiman/initial-setting-laravel/wiki).

## コンテナ構造

```bash
├── mysql
├── nginx
└── php
```

### php コンテナ

- Base image
    - [php](https://hub.docker.com/_/php):8.1-fpm-bullseye
    - [composer](https://hub.docker.com/_/composer):2.2

### nginx コンテナ

- Base image
    - [nginx](https://hub.docker.com/_/nginx):1.22

### mysql コンテナ

- Base image
    - [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server):8.0

### mailhog コンテナ

- Base image
    - [mailhog/mailhog](https://hub.docker.com/r/mailhog/mailhog)
