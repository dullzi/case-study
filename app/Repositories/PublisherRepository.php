<?php

namespace App\Repositories;

use App\Models\Publisher;
use App\Repositories\Contracts\PublisherRepositoryInterface;

class PublisherRepository implements PublisherRepositoryInterface
{
    public function all(array $filters = [])
    {
        $query = Publisher::query();

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
        return Publisher::findOrFail($id);
    }

    public function create(array $data)
    {
        return Publisher::create($data);
    }

    public function update(int $id, array $data)
    {
        $publisher = $this->find($id);
        $publisher->update($data);
        return $publisher;
    }

    public function delete(int $id)
    {
        $publisher = $this->find($id);
        return $publisher->delete();
    }
}
