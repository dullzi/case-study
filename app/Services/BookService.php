<?php

namespace App\Services;

use App\Repositories\Contracts\BookRepositoryInterface;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBooks(array $filters)
    {
        return $this->bookRepository->all($filters);
    }

    public function getBookById(int $id)
    {
        return $this->bookRepository->find($id);
    }

    public function createBook(array $data)
    {
        return $this->bookRepository->create($data);
    }

    public function updateBook(int $id, array $data)
    {
        return $this->bookRepository->update($id, $data);
    }

    public function deleteBook(int $id)
    {
        return $this->bookRepository->delete($id);
    }
}
