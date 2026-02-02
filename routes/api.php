use App\Http\Controllers\AnimalController;

Route::post('/crearAnimal', [AnimalController::class, 'crearAnimal']);