<?php

namespace MG\Infrastructure\Domain\Model\User;


use MG\Infrastructure\Domain\Model\DoctrineEntityId;

class DoctrineUserId extends DoctrineEntityId
{
    public function getName()
    {
        return 'UserId';
    }

    protected function getNamespace()
    {
        return 'MG\Domain\Model\User';
    }
}