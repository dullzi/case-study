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

    /**
     * @OA\Get(
     *      path="/api/v1/books",
     *      operationId="getBooksList",
     *      tags={"Books"},
     *      summary="Get list of books",
     *      description="Returns list of books",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *     )
     */
    public function index(Request $request): JsonResponse
    {
        $books = $this->bookService->getAllBooks($request->all());

        return $this->successResponse(
            new BookCollection($books),
            'Books retrieved successfully'
        );
    }

    /**
     * @OA\Post(
     *      path="/api/v1/books",
     *      operationId="storeBook",
     *      tags={"Books"},
     *      summary="Store new book",
     *      description="Returns book data",
     *      security={{ "bearerAuth": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreBookRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = $this->bookService->createBook($request->validated());

        return $this->successResponse(
            new BookResource($book),
            'Book created successfully',
            201
        );
    }

    /**
     * @OA\Get(
     *      path="/api/v1/books/{id}",
     *      operationId="getBookById",
     *      tags={"Books"},
     *      summary="Get book information",
     *      description="Returns book data",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Book id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function show(int $id): JsonResponse
    {
        $book = $this->bookService->getBookById($id);

        return $this->successResponse(
            new BookResource($book),
            'Book retrieved successfully'
        );
    }

    /**
     * @OA\Put(
     *      path="/api/v1/books/{id}",
     *      operationId="updateBook",
     *      tags={"Books"},
     *      summary="Update existing book",
     *      description="Returns updated book data",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Book id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBookRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        $book = $this->bookService->updateBook($id, $request->validated());

        return $this->successResponse(
            new BookResource($book),
            'Book updated successfully'
        );
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/books/{id}",
     *      operationId="deleteBook",
     *      tags={"Books"},
     *      summary="Delete existing book",
     *      description="Deletes a record and returns no content",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="Book id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        $this->bookService->deleteBook($id);

        return $this->successResponse(null, 'Book deleted successfully');
    }
}
