<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Storage;
class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        return response()->json($this->userRepo->all());
    }

    public function show($id)
    {
        return response()->json($this->userRepo->find($id));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->userRepo->storeAvatar($request->file('avatar'));
        }

        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->create($data);

        return response()->json($user, 201);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();
        $user = $this->userRepo->find($id);

        // Check if a new avatar is uploaded
        if ($request->hasFile('avatar')) {
            // Delete the old avatar if it exists
            $this->userRepo->deleteAvatar($user->avatar);
            $data['avatar'] = $this->userRepo->storeAvatar($request->file('avatar'));
        }

        $user = $this->userRepo->update($id, $data);

        return response()->json($user);
    }

    public function destroy($id)
    {
        $this->userRepo->delete($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
