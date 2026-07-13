<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AdminUserRequest;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * View All Users
     */
    public function index(): JsonResponse
    {
        $users = UserResource::collection(User::paginate(10));
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserRequest $request, User $user): JsonResponse
    {
        DB::transaction(function() use ($request, $user) {
            $user->update($request->validated());
            if ($user->role === 'doctor') {
                $user->doctor()->update($request->validated());
            }
        });
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }
    public function deactivate(User $user): JsonResponse
    {
        if (!$user->is_active)
        {
            return response()->json(['message' => 'User is already inactive'], 422);
        }
        $user->update(['is_active' => false]);
        return response()->json([
            'message' => 'User deactivated successfully.',
        ]);
    }
    public function activate(User $user): JsonResponse
    {
        if ($user->is_active)
        {
            return response()->json(['message' => 'User is already active'], 422);
        }
        $user->update(['is_active' => true]);
        return response()->json([
            'message' => 'User activated successfully.',
        ]);
    }
}
