<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRole()
    {
        return [
            'roles' => $this->roleRepository->get(),
        ];
    }

    public function createRole(array $data)
    {
        return $this->roleRepository->create($data);
    }
}
