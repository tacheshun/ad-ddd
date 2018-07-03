<?php

namespace MG\Application\Service\Ad;


use MG\Domain\Model\Ad\AdDoesNotExistException;
use MG\Domain\Model\Ad\Adid;
use MG\Domain\Model\Ad\AdRepository;
use MG\Domain\Model\User\UserDoesNotExistException;
use MG\Domain\Model\User\UserId;
use MG\Domain\Model\User\UserRepository;

class DeleteAdService
{
    private $adRepository;
    private $userRepository;

    public function __construct(AdRepository $adRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->adRepository = $adRepository;
    }

    public function execute(?DeleteAdRequest $request)
    {
        $userId = $request->userId();
        $adId = $request->adId();

        $user = $this->userRepository->ofId(new UserId($userId));
        if (null === $user) {
            throw new UserDoesNotExistException();
        }

        $ad = $this->adRepository->ofId(new Adid($adId));
        if (!$ad) {
            throw new AdDoesNotExistException();
        }

        if (!$ad->userId()->equals(new UserId($userId))) {
            throw new \InvalidArgumentException('User is not authorized to delete this ad');
        }

        $this->adRepository->remove($ad);
    }
}