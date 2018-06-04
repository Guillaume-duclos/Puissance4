<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 19/04/2018
 * Time: 19:03
 */

namespace App\Controller;

use App\Form\ConnexionForm;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormTypeInterface;
use Twig\Environment;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller {

    /**
     * @Route("/", name="login")
     * @Template("pages/login.html.twig")
     */
    public function index(Request $request, FormFactoryInterface $formFactory, AuthenticationUtils $authenticationUtils) {
        $form = $formFactory->createBuilder(ConnexionForm::class)->getForm();

        $form->handleRequest($request);

        $error = $authenticationUtils->getLastAuthenticationError();

        if($form->isSubmitted() && $form->isValid()) {
            $userData = $form->getData();
            $lastUsername = $authenticationUtils->getLastUsername();
            var_dump($lastUsername);
        }

        return [ 'form' => $form->createView() ];
    }

    private function sendMail($mail, $name) {
        $message = (new \Swift_Message('Votre inscription à été pris en compte.'))
            ->setFrom('guillaume-duclos@hotmail.fr')
            ->setTo($mail)
            ->setBody(
                $this->renderView(
                    'pages/Login.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            );
        $this->mailer->send($message);
    }

}