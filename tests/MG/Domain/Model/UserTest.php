<?php

namespace MG\Domain\Model;


use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_empty_email_should_throw_exception()
    {
        self::expectException(\InvalidArgumentException::class);
        $this->createUserWithEmail('');
    }

    private function createUserWithEmail($email)
    {
        return new User(new UserId(), $email, 'irrelevant-password');
    }

    public function test_invalid_email_should_throw_exception()
    {
        self::expectException(\Assert\InvalidArgumentException::class);
        $this->createUserWithEmail('invalid@email');
    }
}