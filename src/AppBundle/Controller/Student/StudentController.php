<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.18
 * Time: 13.48
 */

namespace AppBundle\Controller\Student;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends Controller
{
    /**
     * @Route("/student", name="student")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(
            'Student/Timetable/fullCalendar.html.twig'
        );
    }
}