<?php

namespace MG\Application\Service\Ad;


use MG\Domain\Model\Ad\Adid;
use MG\Domain\Model\User\UserId;

class DeleteAdRequest
{
    private $adId;
    private $userId;

    public function __construct(Adid $adId, UserId $userId)
    {
        $this->adId = $adId;
        $this->userId = $userId;
    }

    public function adId(): string
    {
        return $this->adId;
    }

    public function userId(): string
    {
        return $this->userId;
    }
}