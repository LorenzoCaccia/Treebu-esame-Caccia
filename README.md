# Prova esame

Nel progetto la Banca della Terra è presente una tabella 'lands' con relativo modello(Land) con i seguenti campi:

    - comune
    - foto
    - dimensione
    - foglio_catastale
    - mappale_catastale
    - parcella_catastale
    - tipo_terreno
    - tipo_irrigazione
    - tipo_offerta
    - canone_offerta
    - disponibile  

Le Ruote Api utilizzate sono:
```
Route::get("/lands", [LandController::class, "list"]);
Route::get("/landsDimension", [LandController::class, "listDimension"]);
Route::get("/lands/{id}", [LandController::class, "detail"]);
Route::post("/lands", [LandController::class, "create"]);
Route::put("/lands/{id}", [LandController::class, "modify"]);
Route::delete("/lands/{id}", [LandController::class, "destroy"]);
```

## Installazione

Nella cartella client, lanciare i comandi
```
yarn install
yarn serve
```

Nellla cartella server, modificare il file '.env' inserendo il nome del database, poi lanciare i comandi
```
composer update
php artisan migrate
php artisan serve
```

