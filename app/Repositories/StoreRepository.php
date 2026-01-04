<?php

namespace App\Repositories;

use App\Interfaces\StoreRepositoryInterface;
use App\Models\Store;
use Illuminate\Support\Facades\Log;

class StoreRepository implements StoreRepositoryInterface
{
    public function getAll(?string $search, ?bool $is_verified, ?int $limit, ?bool $execute)
    {
        Log::info('StoreRepository.', [
            'search' => $search,
            'is_verified' => $is_verified,
            'limit' => $limit,
            'execute' => $execute,
        ]);
        $query = Store::where(function ($query) use ($search, $is_verified) {
            if ($search !== null) {
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

    public function getAllPaginated(?string $search, ?bool $is_verified, ?int $rowPerPage)
    {
        $query = $this->getAll(
            $search,
            $is_verified,
            null,
            false,
        );
        return $query->paginate($rowPerPage);
    }

    public function getById(string $id){
        $query = Store::where('id',$id);
        return $query->first();
    }

    public function create(array $data){
        DB::beginTransaction();

        try {
            $store = new Store;
            $store->user_id= $data['user_id'];
            $store->name= $data['name'];
            $store->logo= $data['logo']->store('assets/store','public');
            $store->about= $data['about'];
            $store->phone= $data['phone'];
            $store->address_id= $data['address_id'];
            $store->city= $data['city'];
            $store->address= $data['address'];
            $store->postal_code= $data['postal_code'];
            $store->save();
            $store->storeBallance()->create([['balance'=>0]]);

            DB::commit();
            return $store;

        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
