<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\StoreResource;
use App\Interfaces\StoreRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    private StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function index(Request $request)
    {
        try {
           $isVerified = $request->boolean('is_verified', null);
            $stores = $this->storeRepository->getAll(
                $request->input('search',null),
               $isVerified,
                $request->input('limit'),
                true
            );
                  Log::info('StoreController: Starting getAll query.', [
                'search' => $request->search,
                'is_verified' => $isVerified,
                'limit' => $request->limit,
                'execute' => $request->execute,
            ]);
            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Di Ambil', StoreResource::collection($stores), 200);

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'search' => 'nullable|string',
                'is_verified' => 'nullable|boolean',
                'row_per_page' => 'required|integer', // Cleaned syntax
            ]);

            $stores = $this->storeRepository->getAllPaginated(
                // Use the validated array data
                $validatedData['search'] ?? null,
                $validatedData['is_verified'] ?? null,
                $validatedData['row_per_page']
            );

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Diambil', StoreResource::make($stores, StoreResource::class), 200);

        } catch (ValidationException $e) {
            // Handle Laravel's validation errors specifically
            return ResponseHelper::jsonResponse(false, 'Validation failed', $e->errors(), 422);
        } catch (\Exception $e) {
            // Catch all other unexpected errors
            \Log::error('Error in getAllPaginated: '.$e->getMessage());

            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
