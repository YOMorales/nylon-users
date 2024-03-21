<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Throwable;

class UsersController extends Controller
{
    // admin_list
    // activate/deactivate
    /**
     * @param UserCreateRequest $request
     */
    public function create(UserCreateRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            User::create($validated);

            return response()->json('Success');
        } catch (Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
