<?php

namespace MG\Domain\Model\User;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\Ad\Adid;

class User
{
    protected $userId;

    protected $email;

    protected $password;

    protected $createdOn;

    protected $updatedOn;

    protected $ads;

    public function __construct(UserId $userId, $email, $password)
    {
        $this->userId = $userId;
        $this->setEmail($email);
        $this->changePassword($password);
        $this->createdOn = new \DateTime();
        $this->updatedOn = new \DateTime();
        $this->ads = new ArrayCollection();
    }

    protected function setEmail($email)
    {
        $email = trim($email);
        if (!$email) {
            throw new \InvalidArgumentException('email');
        }

        Assertion::email($email);
        $this->email = strtolower($email);
    }

    public function changePassword($password)
    {
        $password = trim($password);
        if (!$password) {
            throw new \InvalidArgumentException('password');
        }

        $this->password = $password;
    }

    public function id(): UserId
    {
        return $this->userId;
    }

    public function email(): string
    {
        return $this->email;
    }


    public function password() : string
    {
        return $this->password;
    }

    public function makeAd($nextIdentity, $address, $content): Ad
    {
        return new Ad(
            new Adid(),
            $this->id(),
            $address,
            $content
        );
    }
}
