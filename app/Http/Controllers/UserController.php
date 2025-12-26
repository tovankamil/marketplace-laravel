<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\UserResource;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        try {

            $users = $this->userRepository->getAll($request->search, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Di Ambil', UserResource::collection($users), 200);

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'search' => 'nullable|string', // FIXED SYNTAX
                'row_per_page' => 'required|integer', // Cleaned syntax
            ]);

            $users = $this->userRepository->getAllPaginated(
                // Use the validated array data
                $validatedData['search'] ?? null,
                $validatedData['row_per_page']
            );

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Diambil', PaginateResource::make($users, UserResource::class), 200);

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
    public function store(UserStoreRequest $request)
    {
        //
        $validatedData = $request->validated();

        try {
            $user = $this->userRepository->create($validatedData);

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Ditambahakan', new UserResource($user), 201);

        } catch (\Exception $e) {
            // Catch all other unexpected errors
            \Log::error('Error in getAllPaginated: '.$e->getMessage());

            return ResponseHelper::jsonResponse(false, 'Error input user baru', null, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $id = (string) $id;
            $user = $this->userRepository->getById($id);
            if (! $user) {
                return ResponseHelper::jsonResponse(false, 'Data User Tidak Dapat Diketemukan', null, 404);
            }

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Diambil', new UserResource($user), 200);

        } catch (ValidationException $e) {
            // Handle Laravel's validation errors specifically
            return ResponseHelper::jsonResponse(false, 'Validation failed', $e->errors(), 422);
        } catch (\Exception $e) {
            // Catch all other unexpected errors
            \Log::error('Error in getAllPaginated: '.$e->getMessage());

            return ResponseHelper::jsonResponse(false, 'error', null, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {

        $validatedData = $request->validated();

        try {

            $user = $this->userRepository->getById($id);

            if (! $user) {
                return ResponseHelper::jsonResponse(false, 'Data User Tidak Dapat Diketemukan', null, 404);
            }

            $user = $this->userRepository->update($id, $validatedData);

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Di Update', new UserResource($user), 200);

        } catch (\Exception $e) {
            // Catch all other unexpected errors
            \Log::error('Error in update: '.$e->getMessage());

            return ResponseHelper::jsonResponse(false, 'Error Input User Baru', null, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        try {

            $user = $this->userRepository->getById($id);

            if (! $user) {
                return ResponseHelper::jsonResponse(false, 'Data User Tidak Dapat Diketemukan', null, 404);
            }

            $user = $this->userRepository->delete($id);

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Di Hapus', null, 200);

        } catch (\Exception $e) {
            // Catch all other unexpected errors
            \Log::error('Error in Delete: '.$e->getMessage());

            return ResponseHelper::jsonResponse(false, 'Error Hapus User ', null, 500);
        }
    }
}
