<?php

namespace MG\Application\Service\User;


use MG\Domain\Service\Authentifier;

class LogInUserService
{
    private $authenticationService;

    public function __construct(Authentifier $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function execute($email, $password)
    {
        return $this->authenticationService->authenticate($email, $password);
    }
}