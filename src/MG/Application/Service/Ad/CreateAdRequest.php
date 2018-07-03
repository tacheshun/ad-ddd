<?php

namespace MG\Application\Service\Ad;


class CreateAdRequest
{
    private $userId;
    private $telephone;
    private $content;

    public function __construct($userId, $telephone, $content)
    {
        $this->userId = $userId;
        $this->telephone = $telephone;
        $this->content = $content;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function telephone(): ?string
    {
        return $this->telephone;
    }

    public function content(): ?string
    {
        return $this->content;
    }
}
