public function boot()
{
    parent::boot();
    Route::pattern('id', '[0-9]+');
}
