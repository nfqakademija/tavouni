<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.21
 * Time: 01.00
 */

namespace AppBundle\Authentication;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
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