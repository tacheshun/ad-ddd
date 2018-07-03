<?php

namespace MG\Infrastructure\Controller;

use MG\Application\Service\Ad\CreateAdRequest;
use MG\Application\Service\Ad\CreateAdService;
use MG\Application\Service\User\ViewAdsRequest;
use MG\Application\Service\User\ViewAdsService;
use MG\Domain\Model\Ad\Ad;
use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

        $messages = $this->container->get('session')->getFlashBag()->get('message');
        $repository = $this->getDoctrine()->getManager()->getRepository(Ad::class);

        $ads = (new ViewAdsService($repository))->execute(
            new ViewAdsRequest($userSecurityToken->id()->id())
        );

        return $this->render('@infra/dashboard.html.twig', [
                'ads'      => $ads,
                'messages' => $messages
        ]);
    }

    /**
     * @Route("/ad/create", name="create-ad")
     */
    public function createAdAction(Request $request)
    {
        $userSecurityToken = $this->get('session')->get('user');
        if (!$userSecurityToken) {
            return $this->redirect('/signin');
        }

        $userRepository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $adRepository = $this->getDoctrine()->getManager()->getRepository(Ad::class);
        try {
            $service = new CreateAdService(
                $userRepository,
                $adRepository
            );
            $service->execute(
                    new CreateAdRequest(
                        $userSecurityToken->id()->id(),
                        $request->get('email'),
                        $request->get('content')
                    )
                );
            $this->get('session')->getFlashBag()->add('message', 'Great!');
        } catch (\Exception $e) {
            $this->get('session')->getFlashBag()->add('message', $e->getMessage());
        }

        return $this->redirect('/dashboard');
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

   /**
     * @Route("/view-ad", name="view-ad")
     */
    public function viewAdAction()
    {
        $ad = 1;

        return $this->render('@infra/view-ad.html.twig', [
            'ad' => $ad,
        ]);
    }

   /**
     * @Route("/update-ad", name="update-ad")
     */
    public function updateAdAction()
    {
        throw new \Exception('Not implemented');
    }

    /**
     * @Route("/delete-ad", name="delete-ad")
     */
    public function deleteAdAction()
    {
        throw new \Exception('Not implemented');
    }

}