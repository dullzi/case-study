<?php

namespace App\Services;

use App\Repositories\Contracts\AuthorRepositoryInterface;

class AuthorService
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAllAuthors(array $filters)
    {
        return $this->authorRepository->all($filters);
    }

    public function getAuthorById(int $id)
    {
        return $this->authorRepository->find($id);
    }

    public function createAuthor(array $data)
    {
        return $this->authorRepository->create($data);
    }

    public function updateAuthor(int $id, array $data)
    {
        return $this->authorRepository->update($id, $data);
    }

    public function deleteAuthor(int $id)
    {
        return $this->authorRepository->delete($id);
    }
}
