## Installasi
```
composer require barradev/categorymodule
```

Setelah berhasil diinstal, jalankan perintah

```
php artisan categorymodule:publish
```

## Route
Tambahkan route berikut
```php
Route::resource('category', CategoryController::class)->except('show');
Route::post('category/list', [CategoryController::class, 'list'])->name('list_categories');
```

## Merubah view
Untuk merubah view, dapat dilihat pada folder `resources/views/category/`
