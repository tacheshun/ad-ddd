<?php

namespace MG\Infrastructure\Domain\Event;


use MG\Domain\Event\LoginAttempted;
use Symfony\Component\EventDispatcher\Event;

class SymfonyLogInAttempted extends Event implements LoginAttempted
{
    const NAME = 'login.attempted';

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