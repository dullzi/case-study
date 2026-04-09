<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Publisher\StorePublisherRequest;
use App\Http\Requests\Publisher\UpdatePublisherRequest;
use App\Http\Resources\Api\V1\PublisherResource;
use App\Services\PublisherService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    use ApiResponse;

    protected $publisherService;

    public function __construct(PublisherService $publisherService)
    {
        $this->publisherService = $publisherService;
    }

    public function index(Request $request): JsonResponse
    {
        $publishers = $this->publisherService->getAllPublishers($request->all());

        return $this->successResponse(
            PublisherResource::collection($publishers),
            'Publishers retrieved successfully'
        );
    }

    public function store(StorePublisherRequest $request): JsonResponse
    {
        $publisher = $this->publisherService->createPublisher($request->validated());

        return $this->successResponse(
            new PublisherResource($publisher),
            'Publisher created successfully',
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $publisher = $this->publisherService->getPublisherById($id);

        return $this->successResponse(
            new PublisherResource($publisher),
            'Publisher retrieved successfully'
        );
    }

    public function update(UpdatePublisherRequest $request, int $id): JsonResponse
    {
        $publisher = $this->publisherService->updatePublisher($id, $request->validated());

        return $this->successResponse(
            new PublisherResource($publisher),
            'Publisher updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->publisherService->deletePublisher($id);

        return $this->successResponse(null, 'Publisher deleted successfully');
    }
}
