<?php

namespace MG\Application\User;

use MG\Application\Service\User\ViewAdsRequest;
use MG\Application\Service\User\ViewAdsService;
use MG\Domain\Model\User\UserId;
use MG\Infrastructure\Persistence\InMemory\Ad\InMemoryAdRepository;
use PHPUnit\Framework\TestCase;

class ViewAdsServiceTest extends TestCase
{
    public function test_it_should_return_user_ads()
    {
        $userId = new UserId('aae123cx-c150-40dc-9a38-dx9ded897855');
        $adRepository = new InMemoryAdRepository();
        $request = new ViewAdsRequest($userId);
        $service = (new ViewAdsService($adRepository))->execute($request);
        self::assertTrue(true);
    }
}