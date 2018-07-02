<?php

namespace MG\Infrastructure\Domain\Model\Ad;

use MG\Infrastructure\Domain\Model\DoctrineEntityId;

class DoctrineAdid extends DoctrineEntityId
{
    private const ADID                  = 'Adid';
    private const DOMAIN_MODEL_AD_CLASS = 'MG\Domain\Model\Ad';

    public function getName(): string
    {
        return self::ADID;
    }

    public function getNamespace(): string
    {
        return self::DOMAIN_MODEL_AD_CLASS;
    }
}