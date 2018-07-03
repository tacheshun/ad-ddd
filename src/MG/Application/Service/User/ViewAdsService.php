<?php

namespace MG\Application\Service\User;

use MG\Domain\Model\Ad\AdRepository;
use MG\Domain\Model\User\UserId;

class ViewAdsService
{
    private $adRepository;

    public function __construct(AdRepository $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function execute(?ViewAdsRequest $request): ?array
    {
        return $this->adRepository->ofUserId(new UserId($request->userId()));
    }
}
