<?php

namespace App\Services;

use App\Repositories\Contracts\PublisherRepositoryInterface;

class PublisherService
{
    protected $publisherRepository;

    public function __construct(PublisherRepositoryInterface $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    public function getAllPublishers(array $filters)
    {
        return $this->publisherRepository->all($filters);
    }

    public function getPublisherById(int $id)
    {
        return $this->publisherRepository->find($id);
    }

    public function createPublisher(array $data)
    {
        return $this->publisherRepository->create($data);
    }

    public function updatePublisher(int $id, array $data)
    {
        return $this->publisherRepository->update($id, $data);
    }

    public function deletePublisher(int $id)
    {
        return $this->publisherRepository->delete($id);
    }
}
