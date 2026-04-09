<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PublisherService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublisherController extends Controller
{
    protected $publisherService;

    public function __construct(PublisherService $publisherService)
    {
        $this->publisherService = $publisherService;
    }

    public function index(Request $request)
    {
        $publishers = $this->publisherService->getAllPublishers($request->all());

        return Inertia::render('Publisher/Index', [
            'publishers' => $publishers,
            'filters' => $request->only(['search', 'sort', 'order']),
        ]);
    }

    public function create()
    {
        return Inertia::render('Publisher/Create');
    }

    public function store(\App\Http\Requests\Publisher\StorePublisherRequest $request)
    {
        $this->publisherService->createPublisher($request->validated());

        return redirect()->route('publishers.index')->with('success', 'Publisher created successfully.');
    }

    public function edit(int $id)
    {
        $publisher = $this->publisherService->getPublisherById($id);

        return Inertia::render('Publisher/Edit', [
            'publisher' => $publisher,
        ]);
    }

    public function update(\App\Http\Requests\Publisher\UpdatePublisherRequest $request, int $id)
    {
        $this->publisherService->updatePublisher($id, $request->validated());

        return redirect()->route('publishers.index')->with('success', 'Publisher updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->publisherService->deletePublisher($id);

        return redirect()->route('publishers.index')->with('success', 'Publisher deleted successfully.');
    }
}
