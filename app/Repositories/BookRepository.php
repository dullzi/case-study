<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Book::with(['author', 'publisher']);

        if (isset($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        if (isset($filters['author_id'])) {
            $query->where('author_id', $filters['author_id']);
        }

        if (isset($filters['publisher_id'])) {
            $query->where('publisher_id', $filters['publisher_id']);
        }

        $sort = $filters['sort'] ?? 'created_at';
        $order = $filters['order'] ?? 'desc';
        $query->orderBy($sort, $order);

        $perPage = $filters['per_page'] ?? 15;
        return $query->paginate($perPage);
    }

    public function find(int $id)
    {
        return Book::with(['author', 'publisher'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update(int $id, array $data)
    {
        $book = $this->find($id);
        $book->update($data);
        return $book;
    }

    public function delete(int $id)
    {
        $book = $this->find($id);
        return $book->delete();
    }
}
