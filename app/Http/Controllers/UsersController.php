<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Throwable;

class UsersController extends Controller
{
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

    /**
     * @return JsonResponse
     */
    // DEV NOTE: after building this action that serves JSON, I realized that it would be best suited for an API controller
    public function adminGetUsers(): JsonResponse
    {
        // DEV NOTE: I'm defaulting to a low number of items per page because I expect the dummy data in the database to be small
        $itemsPerPage = request('itemsPerPage', 2);

        $users = User::select(['id', 'first_name', 'last_name', 'email', 'ssn_last_four'])->paginate($itemsPerPage);

        return response()->json($users);
    }
}
