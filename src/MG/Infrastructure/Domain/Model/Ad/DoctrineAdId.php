<?php

namespace MG\Infrastructure\Domain\Model\Ad;


use MG\Infrastructure\Domain\Model\DoctrineEntityId;

class DoctrineAdId extends DoctrineEntityId
{
    public function getName()
    {
        return 'AdId';
    }

    protected function getNamespace()
    {
        return 'MG\Domain\Model\Ad';
    }
}