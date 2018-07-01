<?php

namespace MG\Domain\Event;


class LogInAttempted
{
    private $email;
    private $occurredOn;

    public function __construct($email)
    {
        $this->email = $email;
        $this->occurredOn = new \DateTimeImmutable();
    }

    public function email(): string
    {
        return $this->email;
    }

    public function occurredOn(): \DateTimeImmutable
    {
        return $this->occurredOn;
    }
}