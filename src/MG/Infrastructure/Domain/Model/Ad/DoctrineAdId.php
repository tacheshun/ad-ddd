<?php

namespace MG\Infrastructure\Domain\Model\Ad;


use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\Ad\Adid;
use MG\Infrastructure\Domain\Model\DoctrineEntityId;

class DoctrineAdId extends DoctrineEntityId
{
    public function getName(): string
    {
        return Adid::class;
    }

    protected function getNamespace(): string
    {
        return Ad::class;
    }
}