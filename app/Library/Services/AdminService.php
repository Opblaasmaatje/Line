<?php

namespace App\Library\Services;

use App\Library\Repository\UserRepository;
use App\Models\User;

class AdminService
{
    public function __construct(
        public UserRepository $userRepository
    ){
    }

    public function allAdmins(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->userRepository->admins();
    }

    public function setAdmin(string $discordId, bool $isAdmin): User
    {
        return $this->userRepository->query->updateOrCreate(['discord_id' => $discordId], ['is_admin' => $isAdmin]);
    }
}
