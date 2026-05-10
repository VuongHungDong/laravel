#!/bin/bash
set -e

# Đợi DB khởi động (tuỳ chọn, trên Render DB thường có sẵn)
# Chạy các lệnh tối ưu Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Liên kết thư mục ảnh ra public/storage
php artisan storage:link

# Chạy migration để tự động tạo bảng (chỉ nên chạy nếu database có sẵn cấu hình)
php artisan migrate --force

# Tiếp tục khởi động CMD chính của Dockerfile (ví dụ: apache2-foreground)
exec "$@"
