<?php

namespace MG\Domain\Model\Ad;

use MG\Domain\Model\User\UserId;

interface AdRepository
{
    public function ofId(Adid $adid): ?Ad;

    /**
     * @param UserId $userId
     *
     * @return Ad[]|null
     */
    public function ofUserId(UserId $userId);

    public function add(Ad $ad);

    public function remove(Ad $ad);

    public function nextIdentity(): Adid;
}
