<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['username', 'full_name', 'email', 'password'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    /** Profile page: the single demo user (hash is never selected). */
    public function getDemoUser(): ?array
    {
        return $this->select('id, username, full_name, email, created_at')
                    ->orderBy('id', 'ASC')
                    ->first();
    }

    /** Returns the user row (without hash) on success, null on failure. */
    public function attempt(string $username, string $password): ?array
    {
        $user = $this->where('username', $username)->first();

        // Always run password_verify so timing doesn't reveal valid usernames.
        $hash  = $user['password'] ?? '$2y$10$usesomesillystringfore7hnbRJHxXVLeakoG8K30oukPsA.ztMG';
        $valid = password_verify($password, $hash);

        if ($user === null || ! $valid) {
            return null;
        }

        if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
            $this->update($user['id'], ['password' => password_hash($password, PASSWORD_DEFAULT)]);
        }

        unset($user['password']);

        return $user;
    }
}