<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends BaseSecurityController
{
    public function loginAction(Request $request): Response
    {
        if ($this->isGranted('ROLE_STUDENT')) {
            return $this->redirectToRoute('student_index');
        }

        if ($this->isGranted('ROLE_LECTURER')) {
            return $this->redirectToRoute('lecturer_index');
        }

        return parent::loginAction($request);
    }
}
