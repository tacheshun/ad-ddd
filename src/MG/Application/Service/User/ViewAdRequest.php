<?php

namespace MG\Application\Service\User;


class ViewAdRequest
{
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}
