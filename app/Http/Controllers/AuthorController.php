<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Exibe uma lista de autores (Todos podem visualizar, sem travas)
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    // Mostra o formulario para criar um novo autor
    public function create()
    {
        $this->authorize('create', Author::class);
        return view('authors.create');
    }

    // Armazena um novo autor no banco de dados
    public function store(Request $request)
    {
        $this->authorize('create', Author::class);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email|max:255',
            'birth_date' => 'nullable|date',
        ]);

        Author::create($request->all());

        return redirect()->route('authors.index')->with('success', 'Autor criado com sucesso.');
    }

    // Exibe um autor especifico (Todos podem visualizar, sem travas)
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    // Mostra o formulario para editar um autor existente
    public function edit(Author $author)
    {
        $this->authorize('update', $author);
        return view('authors.edit', compact('author'));
    }

    // Atualiza um autor no banco de dados
    public function update(Request $request, Author $author)
    {
        $this->authorize('update', $author);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email,' . $author->id . '|max:255',
            'birth_date' => 'nullable|date',
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index')->with('success', 'Autor atualizado com sucesso.');
    }

    // Remove um autor do banco de dados
    public function destroy(Author $author)
    {
        $this->authorize('delete', $author);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Autor excluido com sucesso.');
    }
}