# Usar uma imagem base do PHP
# Local da Imagem: C:\laragon\www\intranetdegase\websocket_server\Dockerfile
FROM php:8.1-cli

# Instalar dependências necessárias para a extensão Swoole
RUN apt-get update && apt-get install -y \
    libpq-dev libssl-dev libcurl4-openssl-dev zlib1g-dev libbrotli-dev \
&& docker-php-ext-install pdo pdo_mysql

# Instalar Swoole somente se não estiver instalado
RUN if ! pecl list | grep -q swoole; then \
        pecl install swoole && docker-php-ext-enable swoole; \
    fi

# Copiar o código PHP para a pasta do servidor
COPY ./ /var/www/html/

# Criar e copiar o script start.sh
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Expor a porta 45301
EXPOSE 45301

CMD ["/bin/bash", "/start.sh"]