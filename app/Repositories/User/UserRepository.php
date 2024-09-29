<?php

namespace App\Repositories\User;

use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository implements UserRepositoryInterface
{
    public function all($request)
    {
        // return new User();
        return QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'email'])
            ->allowedSorts(['name']);

    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
        return true;
    }

    public function find($id)
    {
        $user = User::find($id);
        return $user ?: false;
    }
}
