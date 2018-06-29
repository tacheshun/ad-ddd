<?php

namespace MG\Infrastructure\Domain\Model\Ad;

use Doctrine\ORM\EntityRepository;
use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\Ad\Adid;
use MG\Domain\Model\Ad\AdRepository;
use MG\Domain\Model\User\UserId;

class DoctrineAdRepository extends EntityRepository implements AdRepository
{

    public function ofId(Adid $adid): ?Ad
    {
        return $this->find($adid);
    }

    public function ofUserId(UserId $userId): ?Ad
    {
        return $this->findBy(['userId'=>$userId]);
    }

    public function add(Ad $ad)
    {
        $this->getEntityManager()->persist($ad);
    }

    public function remove(Ad $ad)
    {
        $this->getEntityManager()->remove($ad);
    }

    public function nextIdentity(): Adid
    {
        return new Adid();
    }
}
