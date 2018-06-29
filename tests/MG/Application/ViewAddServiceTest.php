<?php

namespace MG\Application;


use MG\Application\Service\User\ViewAdService;
use PHPUnit\Framework\TestCase;

class ViewAddServiceTest extends TestCase
{
    public function test_it_should_view_an_ad()
    {
        $a = new ViewAdService();
    }
}