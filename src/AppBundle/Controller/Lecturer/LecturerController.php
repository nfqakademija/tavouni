<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.18
 * Time: 13.18
 */

namespace AppBundle\Controller\Lecturer;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LecturerController extends Controller
{
    /**
     * @Route("/lecturer", name="lecturer_index")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(
            'Lecturer/lecturer_homepage.html.twig'
        );
    }
}