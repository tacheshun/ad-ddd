<?php

namespace MG\Application\Ad;


use MG\Application\Service\Ad\CreateAdRequest;
use MG\Application\Service\Ad\CreateAdService;
use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Infrastructure\Persistence\InMemory\Ad\InMemoryAdRepository;
use MG\Infrastructure\Persistence\InMemory\User\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class CreateAdServiceTest extends TestCase
{
    private $createAdService;
    private $adRepository;
    private $userRepository;
    private $dummyUser;
    private $dummyAd;

    public function setUp()
    {
        $this->setupUserRepository();
        $this->setupAdRepository();

        $this->createAdService = new CreateAdService(
            $this->userRepository,
            $this->adRepository
        );
    }

    private function setupUserRepository()
    {
        $this->userRepository = new InMemoryUserRepository();
        $this->dummyUser = new User($this->userRepository->nextIdentity(), 'irrelevant@email.com', 'irrelevant');
        $this->userRepository->add($this->dummyUser);
    }

    private function setupAdRepository()
    {
        $this->adRepository = new InMemoryAdRepository();
        $this->dummyAd = $this->dummyUser->makeNewAd($this->adRepository->nextIdentity(), 'irrelevant@email.com', 'content');
        $this->adRepository->add($this->dummyAd);
    }

    public function test_it_should_create_an_ad()
    {
        $this->createAdService->execute(
            new CreateAdRequest(new UserId($this->dummyUser->id()->id()), '0725085121', 'blah content')
        );

        $ad = $this->adRepository->ofId($this->dummyAd->id());

        self::assertNotNull($ad);
        self::assertInstanceOf(Ad::class, $ad);
    }
}