<?php

namespace AppBundle\Authentication;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        if ($token->getUser()->hasRole('ROLE_LECTURER')) {
            return $this->httpUtils->createRedirectResponse($request, 'lecturer_index');
        }

        if ($token->getUser()->hasRole('ROLE_STUDENT')) {
            return $this->httpUtils->createRedirectResponse($request, 'student_index');
        }

        return parent::onAuthenticationSuccess($request, $token);
    }
}
