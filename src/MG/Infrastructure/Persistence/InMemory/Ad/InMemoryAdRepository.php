<?php

namespace MG\Infrastructure\Persistence\InMemory\Ad;


use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\Ad\Adid;
use MG\Domain\Model\Ad\AdRepository;
use MG\Domain\Model\User\UserId;

class InMemoryAdRepository implements AdRepository
{
    private $ads = [];

    public function ofId(Adid $adid): ?Ad
    {
        if (!isset($this->ads[$adid->id()])) {
            return null;
        }

        return $this->ads[$adid->id()];
    }

    public function ofUserId(UserId $userId): ?array
    {
        $ads = [];
        foreach ($this->ads as $ad) {
            if ($ad->id()->equals($userId)) {
                $ads[] = $this->ads[$userId->id()];
            }
        }

        return $ads;
    }

    public function add(Ad $ad)
    {
        $this->ads[$ad->id()->id()] = $ad;
    }

    public function remove(Ad $ad)
    {
        unset($this->ads[$ad->id()->id()]);
    }

    public function nextIdentity(): Adid
    {
        return new Adid();
    }
}