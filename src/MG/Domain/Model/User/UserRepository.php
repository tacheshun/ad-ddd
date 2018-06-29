<?php

namespace MG\Domain\Model\User;


interface UserRepository
{
    public function ofId(UserId $userId): ?User;

    public function ofEmail($email): ?User;

    public function add(User $user);

    public function nextIdentity(): UserId;
}