<?php

namespace MG\Infrastructure\Controller;

use MG\Application\Service\User\ViewAdRequest;
use MG\Application\Service\User\ViewAdService;
use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\User\UserId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction()
    {
        $userSecurityToken = $this->get('session')->get('user');
        if (!$userSecurityToken) {
            return $this->redirect('/signin');
        }

        $flashBag = $this->container->get('session')->getFlashBag();
        $messages = $flashBag->get('message');
        $repository = $this->getDoctrine()->getManager()->getRepository(Ad::class);

        $ads = (new ViewAdService($repository))->execute(
            new ViewAdRequest($userSecurityToken->id()->id())
        );

        return $this->render('@infra/dashboard.html.twig', [
            [
                'ads'      => $ads,
                'messages' => $messages
            ]
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $user = new UserId();
        dump($user);

        return $this->render('@infra/layout.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

}