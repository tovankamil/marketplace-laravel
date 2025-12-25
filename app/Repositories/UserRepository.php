<?php

namespace app\Repositories;

use app\Interfaces\UserRepositoryInterface;
use app\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(?string $search, ?int $limit, bool $execute)
    {
        $query = User::where(function ($query) use ($search) {
            if ($search) {
                $query->search($search);
            }
        });
        if ($limit) {
            $query->take($limit);
        }
        if ($execute) {
            return $query->get();
        }
    }

    public function getAllPaginated(?string $search, ?int $rowPerPage) {
        
        $query = $this->getAll(
            $search,
            null,
            false,
        );

        return $query->paginated($rowPerPage);
    }
}
