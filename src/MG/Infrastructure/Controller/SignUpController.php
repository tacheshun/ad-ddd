<?php

namespace MG\Infrastructure\Controller;


use MG\Application\DataTransformer\User\UserDtoDataTransformer;
use MG\Application\Service\User\SignUpUserRequest;
use MG\Application\Service\User\SignUpUserService;
use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserAlreadyExistException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends Controller
{
    /**
     * @Route("/signup", name="signup")
     */
    public function signupAction(Request $request)
    {
        $form = $this->createFormBuilder( null, [
                'attr' => ['autocomplete' => 'off'],
            ])
        ->add('email', EmailType::class,   ['attr' => ['maxlength' => User::MAX_LENGTH_EMAIL, 'class' => 'form-control'], 'label' => 'Email'])
        ->add('password', PasswordType::class, ['attr' => ['maxlength' => User::MAX_LENGTH_PASSWORD, 'class' => 'form-control'], 'label' => 'Password'])
        ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary btn-lg btn-block'], 'label' => 'Sign up'])
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            try {
                $userRepository = $this->getDoctrine()->getManager()->getRepository(User::class);

                $service = new SignUpUserService(
                    $userRepository,
                    new UserDtoDataTransformer()
                );

                $service->execute(
                    new SignUpUserRequest(
                        $data['email'],
                        $data['password']
                    )
                );
                return $this->redirectToRoute('signin');

            } catch (UserAlreadyExistException $e) {
                $form->get('email')->addError(new FormError('Email is already registered by another user'));
            } catch (\Exception $e) {
                $form->addError(new FormError('There was an error, please get in touch with us'));
            }
        }

        return $this->render('@infra/signin.html.twig', [
               'form' => $form->createView(),
        ]);

    }
}