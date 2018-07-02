<?php

namespace MG\Domain\Model\User;

use Ramsey\Uuid\Uuid;

class UserId
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    public function userId(): string
    {
        return $this->id;
    }

    public function equals(UserId $userId)
    {
        return $this->id() === $userId->id();
    }

    public function __toString()
    {
        return $this->userId();
    }
}