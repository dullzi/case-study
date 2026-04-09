<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Http\Resources\Api\V1\AuthorResource;
use App\Services\AuthorService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    use ApiResponse;

    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index(Request $request): JsonResponse
    {
        $authors = $this->authorService->getAllAuthors($request->all());

        return $this->successResponse(
            AuthorResource::collection($authors),
            'Authors retrieved successfully'
        );
    }

    public function store(StoreAuthorRequest $request): JsonResponse
    {
        $author = $this->authorService->createAuthor($request->validated());

        return $this->successResponse(
            new AuthorResource($author),
            'Author created successfully',
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $author = $this->authorService->getAuthorById($id);

        return $this->successResponse(
            new AuthorResource($author),
            'Author retrieved successfully'
        );
    }

    public function update(UpdateAuthorRequest $request, int $id): JsonResponse
    {
        $author = $this->authorService->updateAuthor($id, $request->validated());

        return $this->successResponse(
            new AuthorResource($author),
            'Author updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->authorService->deleteAuthor($id);

        return $this->successResponse(null, 'Author deleted successfully');
    }
}
