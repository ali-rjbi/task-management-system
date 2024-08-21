<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    const EXPIRES_AFTER_IN_MIN = 5;

    public function find(int $id): User|null
    {
        return User::where('id', $id)->first();
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email = ''): User|null
    {
        if (!$email) {
            return null;
        };

        return User::where('email', $email)->first();
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(User $user, array $newData): bool
    {
        try {
            return $user->update($newData);
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function emailExists(string $email): bool
    {
        return User::where('email', $email)->exists();
    }

    /**
     * @inheritDoc
     */
    public function loginCredentialsMatch(string $email, string $password): bool
    {
        $user = $this->findByEmail($email);

        return $user && Hash::check($password, $user->password);
    }
}
