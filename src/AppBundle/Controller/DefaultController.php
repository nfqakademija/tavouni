<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if ($this->isGranted('ROLE_LECTURER')) {
            return $this->redirectToRoute('lecturer');
        }
        if ($this->isGranted('ROLE_STUDENT')) {
            return $this->redirectToRoute('student');
        }
        // replace this example code with whatever you need
//        return $this->render(
//            'Timetable/fullCalendar.html.twig'
//        );
    }
}
