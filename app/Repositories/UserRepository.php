<?php

namespace App\Repositories;

use App\Models\User;
use Storage;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
    /**
     * Store the avatar image for a user.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string|null
     */
    public function storeAvatar($file)
    {
        return $file->store('avatars', 'public');
    }

    /**
     * Delete the avatar image for a user if it exists.
     *
     * @param string|null $avatarPath
     * @return void
     */
    public function deleteAvatar($avatarPath)
    {
        if ($avatarPath && Storage::exists($avatarPath)) {
            Storage::delete($avatarPath);
        }
    }
}
