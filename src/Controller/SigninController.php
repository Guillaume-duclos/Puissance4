<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 19/04/2018
 * Time: 19:02
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionForm;
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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SigninController extends Controller {

    /**
     * @Route("/signin", name="signin")
     * @Template("pages/SignIn.html.twig")
     */
    public function index(Request $request, FormFactoryInterface $formFactory, UserPasswordEncoderInterface $passwordEncoder) {
        $form = $formFactory->createBuilder(InscriptionForm::class)->getForm();

        $user = new User();
        //$form = $this->createForm(InscriptionForm::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $userSubmit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userSubmit);
            $entityManager->flush();

            return $this->redirectToRoute('login');
        }

        return [
            'form' => $form->createView()
        ];
    }
}