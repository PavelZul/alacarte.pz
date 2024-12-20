:: Если Laravel установлен в корень сайта
@php.exe -d output_buffering=0 "%~dp0..\..\artisan" %*

:: Если Laravel не установлен в корень сайта
:: @php.exe -d output_buffering=0 "%~dp0..\..\laravel\artisan" %*