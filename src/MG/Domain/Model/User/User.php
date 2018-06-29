<?php

namespace MG\Domain\Model\User;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use MG\Domain\Model\Ad\Ad;

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

    public function id(): string
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

    public function makeWishNoAggregateVersion(Adid $adId, $address, $content)
    {
        return new Ad(
            $wishId,
            $this->id(),
            $address,
            $content
        );
    }


    public function grantWishes()
    {
        $wishesGranted = 0;
        foreach ($this->wishes as $wish) {
            $wish->grant();
            ++$wishesGranted;
        }

        return $wishesGranted;
    }

    public function updateWish(WishId $wishId, $address, $content)
    {
        foreach ($this->wishes as $k => $wish) {
            if ($wish->id()->equals($wishId)) {
                $wish->changeContent($content);
                $wish->changeAddress($address);
                break;
            }
        }
    }

    public function deleteWish(WishId $wishId)
    {
        foreach ($this->wishes as $k => $wish) {
            if ($wish->id()->equals($wishId)) {
                unset($this->wishes[$k]);
                break;
            }
        }
    }
}