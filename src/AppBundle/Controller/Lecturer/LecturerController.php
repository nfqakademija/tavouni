<?php

namespace AppBundle\Controller\Lecturer;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LecturerController extends Controller
{
    /**
     * @Route("/lecturer", name="lecturer_index")
     */
    public function indexAction(): Response
    {
        return $this->render(
            'Lecturer/lecturer_homepage.html.twig'
        );
    }
}
