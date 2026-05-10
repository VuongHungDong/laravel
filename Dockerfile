# Sử dụng PHP 8.2 kết hợp Apache (bạn có thể đổi lên 8.3 nếu muốn)
FROM php:8.2-apache

# Cài đặt các thư viện hệ thống cần thiết
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libicu-dev \
    libonig-dev \
    libpq-dev \
    python3 \
    && rm -rf /var/lib/apt/lists/*

# Cài đặt Node.js và npm (để build giao diện TailwindCSS/Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Cấu hình và cài đặt các extension PHP cần cho Laravel & Spatie Media Library
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip intl

# Kích hoạt Apache mod_rewrite và đảm bảo chỉ dùng mpm_prefork (tránh lỗi AH00534 trên một số nền tảng Cloud)
RUN a2dismod mpm_event mpm_worker || true \
    && a2enmod mpm_prefork rewrite

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Cấu hình lại Document Root của Apache trỏ vào thư mục public của Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy mã nguồn dự án vào container
COPY . /var/www/html/

# Copy file môi trường mặc định (Render sẽ ghi đè biến môi trường trong phần cài đặt trên web)
RUN cp .env.example .env

# Cài đặt các gói thư viện backend (PHP)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Tạo APP_KEY tự động nếu chưa có (cần thiết cho CSRF Token)
RUN php artisan key:generate --force

# Cài đặt và build giao diện frontend (JS/CSS)
RUN npm install && npm run build

# Xuất bản assets của Filament (CSS/JS cho trang Admin)
RUN php artisan filament:assets

# Phân quyền lại cho thư mục storage và bootstrap/cache để ứng dụng có thể ghi log/cache/hình ảnh
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Mở cổng 80 (mặc định cho Render)
EXPOSE 80

# Đặt quyền thực thi cho file khởi động (entrypoint)
RUN chmod +x /var/www/html/docker-entrypoint.sh

ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]

# Lệnh khởi chạy Apache mặc định
CMD ["apache2-foreground"]
