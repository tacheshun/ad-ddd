<?php

namespace MG\Application\Service\User;


use MG\Application\DataTransformer\User\UserDtoDataTransformer;
use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserAlreadyExistException;
use MG\Domain\Model\User\UserRepository;

class SignUpUserService
{
    private $userRepository;
    private $userDataTransformer;

    public function __construct(
        UserRepository $userRepository,
        UserDtoDataTransformer $userDataTransformer
    ) {
        $this->userRepository = $userRepository;
        $this->userDataTransformer = $userDataTransformer;
    }

    public function execute(?SignUpUserRequest $request): array
    {
        $email    = $request->email();
        $password = $request->password();

        $user = $this->userRepository->ofEmail($email);
        if (null !== $user) {
            throw new UserAlreadyExistException();
        }

        $user = new User(
            $this->userRepository->nextIdentity(),
            $email,
            $password
        );

        $this->userRepository->add($user);
        $this->userDataTransformer->write($user);

        return $this->userDataTransformer->read();
    }
}
