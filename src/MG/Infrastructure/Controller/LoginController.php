<?php

namespace MG\Infrastructure\Controller;


use MG\Application\Service\User\LogInUserService;
use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserAlreadyExistException;
use MG\Infrastructure\Domain\Service\SessionAuthentifier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends Controller
{
    /**
     * @Route("/signin", name="signin")
     */
    public function signInAction(Request $request)
    {
        $form = $this->createFormBuilder(null, [
                    'attr' => ['autocomplete' => 'off'],
                ])
                ->add('email', EmailType::class,       ['attr' => ['maxlength' => User::MAX_LENGTH_EMAIL, 'class' => 'form-control'], 'label' => 'Email'])
                ->add('password', PasswordType::class, ['attr' => ['maxlength' => User::MAX_LENGTH_PASSWORD, 'class' => 'form-control'], 'label' => 'Password'])
                ->add('submit', SubmitType::class,     ['attr' => ['class' => 'btn btn-primary btn-lg btn-block'], 'label' => 'Sign in'])
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            try {
                $userRepository = $this->getDoctrine()->getManager()->getRepository(User::class);
                $session = $this->container->get('session');

                $service = new LogInUserService(
                    new SessionAuthentifier(
                        $userRepository,
                        $session
                    )
                );

                $result = $service->execute($data['email'], $data['password']);
                if ($result) {
                    return $this->redirect('/dashboard');
                }
            } catch (UserAlreadyExistException $e) {
                $form->get('email')->addError(new FormError('Email is already registered by another user'));
            } catch (\Exception $e) {
                $form->addError(new FormError('There was an error, please get in touch with us'));
            }
        }

        return $this->render('@infra/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/signout", name="signout")
     */
    public function signoutAction()
    {
        return true;
    }
}