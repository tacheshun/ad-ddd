<?php

namespace MG\Domain\Event;


interface LoginAttempted
{
    public function email(): string;
    public function occurredOn(): \DateTimeImmutable;
}