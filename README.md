# initial-setting-laravel(docker ๐ณ)

<img src="https://user-images.githubusercontent.com/35098175/145682384-0f531ede-96e0-44c3-a35e-32494bd9af42.png" alt="docker-laravel">

## Introduction

Build a simple laravel development environment with docker-compose. Compatible with Windows(WSL2), macOS(M1) and Linux.

## ไฝฟ็จๆนๆณ

ใใซใใใ

ไธ่จใฎใณใใณใใ ใใงไฝฟใใใใใซใชใใพใใ

```zsh:
make init
```

http://localhost

## ๅ่

- Read this [Makefile](https://github.com/daishiman/initial-setting-laravel/blob/main/Makefile).
- Read this [Wiki](https://github.com/daishiman/initial-setting-laravel/wiki).

## ใณใณใใๆง้ 

```bash
โโโ mysql
โโโ nginx
โโโ php
```

### php ใณใณใใ

- Base image
    - [php](https://hub.docker.com/_/php):8.1-fpm-bullseye
    - [composer](https://hub.docker.com/_/composer):2.2

### nginx ใณใณใใ

- Base image
    - [nginx](https://hub.docker.com/_/nginx):1.22

### mysql ใณใณใใ

- Base image
    - [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server):8.0

### mailhog ใณใณใใ

- Base image
    - [mailhog/mailhog](https://hub.docker.com/r/mailhog/mailhog)
