<?php

namespace App\Interfaces;

interface StoreRepositoryInterface {
    public function getAll(?string $search, ?bool $is_verified, ?int $limit, ?bool $execute);
    public function getAllPaginated(?string $search, bool $is_verified, ?int $rowPerPage);
}