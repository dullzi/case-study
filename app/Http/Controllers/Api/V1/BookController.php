<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Api\V1\BookResource;
use App\Http\Resources\Api\V1\BookCollection;
use App\Services\BookService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiResponse;

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(Request $request): JsonResponse
    {
        $books = $this->bookService->getAllBooks($request->all());

        return $this->successResponse(
            new BookCollection($books),
            'Books retrieved successfully'
        );
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = $this->bookService->createBook($request->validated());

        return $this->successResponse(
            new BookResource($book),
            'Book created successfully',
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $book = $this->bookService->getBookById($id);

        return $this->successResponse(
            new BookResource($book),
            'Book retrieved successfully'
        );
    }

    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        $book = $this->bookService->updateBook($id, $request->validated());

        return $this->successResponse(
            new BookResource($book),
            'Book updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->bookService->deleteBook($id);

        return $this->successResponse(null, 'Book deleted successfully');
    }
}
