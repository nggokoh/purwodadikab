FROM php:8.2-apache

# Copy semua file ke direktori web server Apache
COPY . /var/www/html/

# (Opsional) Aktifkan mod_rewrite jika kamu pakai routing seperti Laravel
RUN a2enmod rewrite

EXPOSE 80
