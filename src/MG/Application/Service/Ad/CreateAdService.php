<?php

namespace MG\Application\Service\Ad;


use MG\Domain\Model\Ad\AdRepository;
use MG\Domain\Model\User\UserDoesNotExistException;
use MG\Domain\Model\User\UserId;
use MG\Domain\Model\User\UserRepository;

class CreateAdService
{
    private $userRepository;
    private $adRepository;

    public function __construct(UserRepository $userRepository, AdRepository $adRepository)
    {
        $this->userRepository = $userRepository;
        $this->adRepository = $adRepository;
    }

    public function execute(CreateAdRequest $request)
    {
        $userId    = $request->userId();
        $telephone = $request->telephone();
        $content   = $request->content();

        $user = $this->findUserOrFail($userId);

        $ad = $user->makeAd(
            $this->adRepository->nextIdentity(),
            $telephone,
            $content
        );

        $this->adRepository->add($ad);
    }

    protected function findUserOrFail($userId)
    {
        $user = $this->userRepository->ofId(new UserId($userId));
        if (null === $user) {
            throw new UserDoesNotExistException();
        }

        return $user;
    }
}
