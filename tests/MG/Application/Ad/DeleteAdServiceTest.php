<?php

namespace MG\Application\Ad;


use MG\Application\Service\Ad\DeleteAdRequest;
use MG\Application\Service\Ad\DeleteAdService;
use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\Ad\AdDoesNotExistException;
use MG\Domain\Model\Ad\Adid;
use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Infrastructure\Persistence\InMemory\Ad\InMemoryAdRepository;
use MG\Infrastructure\Persistence\InMemory\User\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class DeleteAdServiceTest extends TestCase
{
    private $userRepository;
    private $deleteAdService;
    private $dummyUser;
    private $adRepository;
    private $dummyAd;

    public function setUp()
    {
        $this->setupUserRepository();
        $this->setupAdRepository();

        $this->deleteAdService = new DeleteAdService(
            $this->adRepository,
            $this->userRepository
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

    public function test_removing_non_existing_ad_throws_exception()
    {
        self::expectException(AdDoesNotExistException::class);
        $this->deleteAdService->execute(
            new DeleteAdRequest(new Adid('non-existent'),  new UserId($this->dummyUser->id()->id()))
        );
    }

    public function test_it_should_remove_ad()
    {
        $this->deleteAdService->execute(
            new DeleteAdRequest(new Adid($this->dummyAd->id()->id()), new UserId($this->dummyUser->id()->id()))
        );

        self::assertNull($this->adRepository->ofId($this->dummyAd->id()));
    }

    public function test_remove_ad_from_a_user_that_does_not_own_it_should_throw_exception()
    {
        self::expectException(\InvalidArgumentException::class);
        $ad = new Ad(
            $this->adRepository->nextIdentity(),
            $this->userRepository->nextIdentity(),
            'irrelevant@email.com',
            'content'
        );

        $this->adRepository->add($ad);

        $this->deleteAdService->execute(
            new DeleteAdRequest(new Adid($ad->id()->id()), new UserId($this->dummyUser->id()->id()))
        );
    }
}