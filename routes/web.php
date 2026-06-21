<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowingController;

// Rota pública inicial (Acessível sem login)
Route::get('/', function () {
    return view('welcome');
});

// Rotas automáticas de autenticação (Login, Registro, etc.)
Auth::routes();

// Rota da Dashboard interna (Já redireciona para home)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ================================================================
// GRUPO DE SEGURANÇA: Só quem está LOGADO acessa o que está aqui dentro
// ================================================================
Route::middleware(['auth'])->group(function () {

    Route::resource('categories', CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('publishers', PublisherController::class);

    // Rotas para criação de livros
    Route::get('/books/create-id-number', [BookController::class, 'createWithId'])->name('books.create.id');
    Route::post('/books/create-id-number', [BookController::class, 'storeWithId'])->name('books.store.id');

    Route::get('/books/create-select', [BookController::class, 'createWithSelect'])->name('books.create.select');
    Route::post('/books/create-select', [BookController::class, 'storeWithSelect'])->name('books.store.select');

    // Rotas RESTful para index, show, edit, update, delete
    Route::resource('books', BookController::class)->except(['create', 'store']);

    // Gerenciamento de usuários
    Route::resource('users', UserController::class)->except(['create', 'store', 'destroy']);

    // Rota para registrar um empréstimo
    Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('books.borrow');

    // Rota para listar o histórico de empréstimos de um usuário
    Route::get('/users/{user}/borrowings', [BorrowingController::class, 'userBorrowings'])->name('users.borrowings');

    // Rota para registrar a devolução
    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');

});