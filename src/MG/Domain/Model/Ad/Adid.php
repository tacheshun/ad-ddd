<?php

namespace MG\Domain\Model\Ad;

use Ramsey\Uuid\Uuid;

class Adid
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function equals(Adid $userId)
    {
        return $this->id() === $userId->id();
    }

    public function __toString()
    {
        return $this->id();
    }
}