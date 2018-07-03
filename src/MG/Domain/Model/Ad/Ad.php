<?php

namespace MG\Domain\Model\Ad;

use Assert\Assertion;
use MG\Domain\Model\User\UserId;

class Ad
{
    protected $adid;

    protected $userId;

    protected $content;

    protected $telephone;

    protected $createdOn;

    protected $updatedOn;


    public function __construct(Adid $adid, UserId $userId, $telephone, $content)
    {
        $this->adid   = $adid;
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
        return $this->adid;
    }

    public function userId(): UserId
    {
        return $this->userId;
    }

    public function changeContent($content): self
    {
        $this->setContent($content);

        return $this;
    }

    public function changePhoto($photo): self
    {
        $this->setTelephone($photo);

        return $this;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function telephone(): string
    {
        return $this->telephone;
    }
}
