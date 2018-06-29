<?php

namespace MG\Domain\Model\Ad;


use Assert\Assertion;
use MG\Domain\Model\User\UserId;

class Ad
{
    protected $adId;

    protected $userId;

    protected $content;

    protected $telephone;

    protected $createdOn;

    protected $updatedOn;


    public function __construct(Adid $wishId, UserId $userId, $telephone, $content)
    {
        $this->adId = $wishId;
        $this->userId = $userId;

        $this->setContent($content);
        $this->setTelephone($telephone);

        $this->createdOn = new \DateTime();
        $this->updatedOn = new \DateTime();
    }

    protected function setContent($content)
    {
        $content = trim($content);
        if (!$content) {
            throw new \InvalidArgumentException('Message cannot be empty');
        }

        Assertion::notEmpty($content);
        $this->content = $content;
    }

    private function setTelephone($telephone)
    {
        $telephone = trim($telephone);
        if (!$telephone) {
            throw new \InvalidArgumentException('Telephone cannot be empty');
        }

        Assertion::notEmpty($telephone);
        $this->telephone = $telephone;
    }

    public function id(): Adid
    {
        return $this->adId;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function telephone(): string
    {
        return $this->telephone;
    }

    public function changeContent($content)
    {
        $this->setContent($content);

        return $this;
    }

    public function changePhoto($photo)
    {
        $this->setTelephone($photo);

        return $this;
    }

    public function content()
    {
        return $this->content;
    }
}