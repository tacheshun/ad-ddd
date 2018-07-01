<?php

namespace MG\Infrastructure\Domain\Service;


use MG\Domain\Model\User\User;
use MG\Domain\Service\Authentifier;
use MG\Domain\Service\UserSecurityToken;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionAuthentifier extends Authentifier
{
    private $session;

    public function __construct($repository, Session $session)
    {
        parent::__construct($repository);
        $this->session = $session;
    }

    protected function persistAuthentication(User $user)
    {
        $this->session->set('user', UserSecurityToken::fromUser($user));
    }

    protected function isAlreadyAuthenticated()
    {
        return $this->session->has('user');
    }

    public function logout()
    {
        return $this->session->clear();
    }
}