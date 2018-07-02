<?php

namespace MG\Infrastructure\Controller;

use MG\Domain\Model\User\UserId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $u = new UserId();
        dump($u);
        // replace this example code with whatever you need
        return $this->render('@infra/layout.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}