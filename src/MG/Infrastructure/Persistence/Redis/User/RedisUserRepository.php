<?php

namespace MG\Infrastructure\Persistence\Redis\User;


use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Domain\Model\User\UserRepository;
use Predis\Client as RedisClient;

class RedisUserRepository implements UserRepository
{
    private $predis;

    public function __construct(RedisClient $predis)
    {
        $this->predis = $predis;
    }

    public function ofId(UserId $userId): ?User
    {
        $content = $this->predis->get($userId);
        if ($content && $user = unserialize($content)) {
            return $user;
        }
        return null;
    }

    public function ofEmail($email): ?User
    {
        $content = $this->predis->get($email);
        if ($content && $user = unserialize($content)) {
            return $user;
        }

        return null;
    }

    public function add(User $user)
    {
        $serializedUser = serialize($user);
        $this->predis->set($user->id()->id(), $serializedUser);
        $this->predis->set($user->email(), serialize($user));
    }

    public function nextIdentity(): UserId
    {
        return new UserId();
    }
}