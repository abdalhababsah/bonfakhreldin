@echo off
cd /d C:\xampp\htdocs\bonfakhreldin
php artisan queue:work --tries=3 --timeout=90
pause
