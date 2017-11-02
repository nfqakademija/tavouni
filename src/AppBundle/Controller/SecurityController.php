<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseSecurityController
{
    public function loginAction(Request $request)
    {
        if ($this->isGranted('ROLE_USER'))
        {
            return $this->redirectToRoute('homepage');
        }
        else
        {
            return parent::loginAction($request);
        }
    }
}
