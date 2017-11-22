<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.18
 * Time: 13.48
 */

namespace AppBundle\Controller\Student;

use AppBundle\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * @Route("/student")
 */
class StudentController extends Controller
{
    /**
     * @Route("", name="student_index")
     */
    public function indexAction(Request $request, TokenStorage $tokenStorage, PostRepository $postRepository)
    {
        $id = $tokenStorage->getToken()->getUser()->getId();
        $posts = $postRepository->getPostsForStudent($id);
        // replace this example code with whatever you need
        return $this->render(
            'Student/student_homepage.html.twig', [
                'posts' =>$posts
            ]
        );
    }

    /**
     * @Route("/timetable", name="student_timetable")
     */
    public function timetableAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(
            'Student/Timetable/student_calendar.html.twig'
        );
    }
}