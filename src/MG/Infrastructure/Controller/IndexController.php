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
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $u = new UserId();
        dump($u);

        return $this->render('@infra/layout.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction()
    {
        $userSecurityToken = $this->get('security.token_storage')->getToken()->getUser();
        dump($userSecurityToken);die;
        if (!$userSecurityToken) {
            return $this->redirect('/signin');
        }

        $flashBag = $this->container->get('session')->getFlashBag();
        $messages = $flashBag->get('message');
        $repository = $this->getDoctrine()->getManager()->getRepository(Ad::class);

        $response = (new ViewAdService($repository))->execute(
            new ViewAdRequest($userSecurityToken->id()->id())
        );

        $badges = [];
        return $this->render('@infra/dashboard.html.twig', [
            [
                'ads' => $response,
                'badges' => $badges,
                'messages' => $messages
            ]
        ]);
    }
}