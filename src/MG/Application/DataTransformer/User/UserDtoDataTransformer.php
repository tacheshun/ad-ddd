<?php

namespace MG\Application\DataTransformer\User;


use MG\Domain\Model\User\User;

class UserDtoDataTransformer
{
    /**
     * @var User
     */
    private $user;

    public function write(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function read(): array
    {
        return [
            'id'      => $this->user->id()->userId(),
            'num_ads' => 0,
        ];
    }
}
