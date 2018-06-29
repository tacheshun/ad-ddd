<?php

namespace MG\Application\Service\Ad;


use MG\Domain\Model\User\UserId;

class CreateAdRequest
{
    private $userId;
    private $email;
    private $content;

    public function __construct(UserId $userId, $email, $content)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->content = $content;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function content(): string
    {
        return $this->content;
    }
}
