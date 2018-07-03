<?php

namespace MG\Application\Service\Ad;


use MG\Domain\Model\Ad\Adid;
use MG\Domain\Model\User\UserId;

class UpdateAdRequest
{
    private $userId;
    private $email;
    private $content;
    private $adId;

    public function __construct(UserId $userId, Adid $adId, $email, $content)
    {
        $this->userId = $userId;
        $this->email = $email;
        $this->content = $content;
        $this->adId = $adId;
    }


    public function userId(): string
    {
        return $this->userId;
    }


    public function email(): string
    {
        return $this->email;
    }


    public function adId(): string
    {
        return $this->adId;
    }

    public function content(): string
    {
        return $this->content;
    }
}