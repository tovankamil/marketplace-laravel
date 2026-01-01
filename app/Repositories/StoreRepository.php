<?php

namespace App\Repositories;

use App\Interfaces\StoreRepositoryInterface;
use App\Models\Store;
use Illuminate\Support\Facades\Log;
class StoreRepository implements StoreRepositoryInterface
{
    public function getAll(?string $search, ?bool $is_verified, ?int $limit, ?bool $execute)
    {
        Log::info('StoreRepository: Starting getAll query.', [
        'search' => $search, 
        'is_verified' => $is_verified, 
        'limit' => $limit, 
        'execute' => $execute
    ]);
        $query = Store::where(function ($query) use ($search, $is_verified) {
            if ($search !==null) {
                $query->search($search);
            }
            if ($is_verified !== null) {
                $query->where('is_verified', $is_verified);
            }
        });

        if ($limit) {
            $query->take($limit);
        }
        if ($execute) {
            return $query->get();
        }

        return $query;
    }

    public function getAllPaginated(?string $search, bool $is_verified, ?int $rowPerPage)
    {

        $query = $this->getAll(
            $search,
            $is_verified,
            null,
            false,
        );

        return $query->paginate($rowPerPage);
    }
}
