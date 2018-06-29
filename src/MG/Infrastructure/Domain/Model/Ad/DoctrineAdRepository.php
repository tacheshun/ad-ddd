<?php

namespace MG\Infrastructure\Domain\Model\Ad;

use Doctrine\ORM\EntityRepository;
use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\Ad\Adid;
use MG\Domain\Model\Ad\AdRepository;
use MG\Domain\Model\User\UserId;

class DoctrineAdRepository extends EntityRepository implements AdRepository
{

    public function ofId(Adid $userId): Ad
    {
        // TODO: Implement ofId() method.
    }

    public function ofUserId(UserId $userId): Ad
    {
        // TODO: Implement ofUserId() method.
    }

    public function add(Ad $user)
    {
        // TODO: Implement add() method.
    }

    public function remove(Ad $wish)
    {
        // TODO: Implement remove() method.
    }

    public function nextIdentity(): Adid
    {
        // TODO: Implement nextIdentity() method.
    }
}