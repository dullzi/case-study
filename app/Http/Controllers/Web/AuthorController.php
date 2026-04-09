<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\AuthorService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request)
    {
        $authors = $this->authorService->getAllAuthors($request->all());

        return Inertia::render('Author/Index', [
            'authors' => $authors,
            'filters' => $request->only(['search', 'sort', 'order']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Author/Create');
    }

    public function store(\App\Http\Requests\Author\StoreAuthorRequest $request)
    {
        $this->authorService->createAuthor($request->validated());

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function edit(int $id)
    {
        $author = $this->authorService->getAuthorById($id);

        return Inertia::render('Author/Edit', [
            'author' => $author,
        ]);
    }

    public function update(\App\Http\Requests\Author\UpdateAuthorRequest $request, int $id)
    {
        $this->authorService->updateAuthor($id, $request->validated());

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->authorService->deleteAuthor($id);

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
