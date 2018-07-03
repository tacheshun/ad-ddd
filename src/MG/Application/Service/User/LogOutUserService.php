<?php

namespace MG\Application\Service\User;


use MG\Domain\Service\Authentifier;

class LogOutUserService
{
    private $authenticationService;

    public function __construct(Authentifier $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function execute()
    {
        return $this->authenticationService->logout();
    }
}