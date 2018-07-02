<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__.'/vendor/autoload.php';

\Doctrine\DBAL\Types\Type::addType('UserId', 'MG\Infrastructure\Domain\Model\User\DoctrineUserId');
\Doctrine\DBAL\Types\Type::addType('Adid', 'MG\Infrastructure\Domain\Model\Ad\DoctrineAdid');

$config = Setup::createYAMLMetadataConfiguration([__DIR__ . '/src/MG/Infrastructure/Persistence/Doctrine/Mapping'], true);

$conn = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/var/data/data.sqlite',
);

$entityManager = \Doctrine\ORM\EntityManager::create($conn, $config);

return ConsoleRunner::createHelperSet($entityManager);