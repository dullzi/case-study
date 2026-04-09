<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Contracts\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Author::query();

        if (isset($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        $sort = $filters['sort'] ?? 'created_at';
        $order = $filters['order'] ?? 'desc';
        $query->orderBy($sort, $order);

        $perPage = $filters['per_page'] ?? 15;
        return $query->paginate($perPage);
    }

    public function find(int $id)
    {
        return Author::findOrFail($id);
    }

    public function create(array $data)
    {
        return Author::create($data);
    }

    public function update(int $id, array $data)
    {
        $author = $this->find($id);
        $author->update($data);
        return $author;
    }

    public function delete(int $id)
    {
        $author = $this->find($id);
        return $author->delete();
    }
}
