<?php

namespace MG\Infrastructure\Domain\Model\Ad;

use MG\Infrastructure\Domain\Model\DoctrineEntityId;

class DoctrineAdid extends DoctrineEntityId
{
    private const ADID               = 'Adid';
    private const MG_DOMAIN_MODEL_AD = 'MG\Domain\Model\Ad';

    public function getName(): string
    {
        return self::ADID;
    }

    public function getNamespace(): string
    {
        return self::MG_DOMAIN_MODEL_AD;
    }
}