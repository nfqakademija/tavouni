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
            return new RedirectResponse('lecturer');
        }

        if ($token->getUser()->hasRole('ROLE_STUDENT')) {
            return new RedirectResponse('student');
        }

        return parent::onAuthenticationSuccess($request, $token);
    }

}