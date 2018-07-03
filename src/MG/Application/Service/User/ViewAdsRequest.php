<?php

namespace MG\Application\Service\User;


class ViewAdsRequest
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
