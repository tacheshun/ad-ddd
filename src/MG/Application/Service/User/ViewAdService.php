<?php

namespace MG\Application\Service\User;

use MG\Domain\Model\Ad\AdRepository;
use MG\Domain\Model\User\UserId;

class ViewAdService
{
    private $adRepository;

    public function __construct(AdRepository $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function execute($request = null)
    {
        return $this->adRepository->ofUserId(new UserId($request->userId()));
    }
}
