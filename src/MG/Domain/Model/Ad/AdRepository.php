<?php

namespace MG\Domain\Model\Ad;

use MG\Domain\Model\User\UserId;

interface AdRepository
{
    public function ofId(Adid $userId): ?Ad;

    public function ofUserId(UserId $userId): ?Ad;

    public function add(Ad $ad);

    public function remove(Ad $ad);

    public function nextIdentity(): Adid;
}
