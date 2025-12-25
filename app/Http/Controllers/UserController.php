<?php

namespace App\Http\Controllers;

use app\Interfaces\UserRepositoryInterface;
use app\Resources\PagninateResource;
use app\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->$userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        try {

            $users = $this->userRepository->getAll($request->seach, $request->limit, true);

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Di Ambil', UserResource::collection($users), 200);

        } catch (\Exception $e) {
            return ResponseHelper::jsonResponse(false, $e->getMessage(), null, 500);
        }
    }

    public function getAllPaginated(Request $request)
    {
        $request = $request->validate([
            'search' => 'null | string',
            'row_per_page' => 'required | integer',
        ]);
        try {
            $users = $this->userRepository->getAllPaginated(
                $request['search'] ?? null,
                $request['row_per_page']
            );

            return ResponseHelper::jsonResponse(true, 'Data User Berhasil Diambil', PagninateResource::make($users, UserResource::class), 200);

        } catch (\Exception $e) {
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
