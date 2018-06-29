<?php

namespace MG\Domain\Model\Ad;

use MG\Domain\Model\User\UserId;

interface AdRepository
{
    public function ofId(Adid $userId): Ad;

    public function ofUserId(UserId $userId): Ad;

    public function add(Ad $user);

    public function remove(Ad $wish);

    public function nextIdentity(): Adid;
}