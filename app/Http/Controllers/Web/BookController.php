<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\PublisherService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    protected $bookService;
    protected $authorService;
    protected $publisherService;

    public function __construct(
        BookService $bookService,
        AuthorService $authorService,
        PublisherService $publisherService
    ) {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
        $this->publisherService = $publisherService;
    }

    public function index(Request $request)
    {
        $books = $this->bookService->getAllBooks($request->all());
        $authors = $this->authorService->getAllAuthors(['per_page' => 100]);
        $publishers = $this->publisherService->getAllPublishers(['per_page' => 100]);

        return Inertia::render('Book/Index', [
            'books' => $books,
            'authors' => $authors->items(),
            'publishers' => $publishers->items(),
            'filters' => $request->only(['search', 'sort', 'order', 'author_id', 'publisher_id']),
        ]);
    }

    public function create()
    {
        $authors = $this->authorService->getAllAuthors(['per_page' => 100]);
        $publishers = $this->publisherService->getAllPublishers(['per_page' => 100]);

        return Inertia::render('Book/Create', [
            'authors' => $authors->items(),
            'publishers' => $publishers->items(),
        ]);
    }

    public function store(\App\Http\Requests\Book\StoreBookRequest $request)
    {
        $this->bookService->createBook($request->validated());

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit(int $id)
    {
        $book = $this->bookService->getBookById($id);
        $authors = $this->authorService->getAllAuthors(['per_page' => 100]);
        $publishers = $this->publisherService->getAllPublishers(['per_page' => 100]);

        return Inertia::render('Book/Edit', [
            'book' => $book,
            'authors' => $authors->items(),
            'publishers' => $publishers->items(),
        ]);
    }

    public function update(\App\Http\Requests\Book\UpdateBookRequest $request, int $id)
    {
        $this->bookService->updateBook($id, $request->validated());

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->bookService->deleteBook($id);

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
