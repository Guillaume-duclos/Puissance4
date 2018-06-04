<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends Controller {

    public function logged(EntityManagerInterface $em, Request $request, AuthenticationUtils $authUtils) {

        return $this->render('security/logged.html.twig', array(
            'username' => $username,
            'password' => $password,
        ));
    }

    public function login(Request $request, AuthenticationUtils $authUtils) {
        error_log(".Login.");
        $username = $request->get('_username');
        $password = $request->get('_password');

        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('page/Login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}