<?php

namespace MG\Domain\Service;

use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;

class UserSecurityToken
{
    private $userId;
    private $email;

    private function __construct(UserId $userId, $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    public static function fromUser(User $user): self
    {
        return new self($user->id(), $user->email());
    }

    public function id(): UserId
    {
        return $this->userId;
    }

    public function email(): string
    {
        return $this->email;
    }
}
