<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.18
 * Time: 13.48
 */

namespace AppBundle\Controller\Student;

use AppBundle\Entity\Post;
use AppBundle\Entity\SubjectGrades;
use AppBundle\Repository\GradeRepository;
use AppBundle\Repository\PostRepository;
use AppBundle\Utils\SubjectGradeParser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            'Student/student_homepage.html.twig',
            [
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

    /**
     * @Route("/set-post-seen/{id}", name="student_post_seen")
     */
    public function postSeenAction(Request $request, Post $post)
    {
        if ($this->isGranted('ROLE_STUDENT')) {
            if ($post === null) {
                return new Response(null, Response::HTTP_NOT_FOUND);
            }
            $post->addSeenByStudent($this->getUser()->getStudent());
            $this->getDoctrine()->getManager()->flush();

            return new Response(null, Response::HTTP_OK);
        }
        return new Response(null, Response::HTTP_FORBIDDEN);
    }

    /**
     * @Route("/grades", name="student_grades")
     */
    public function gradesAction(Request $request, TokenStorage $tokenStorage, SubjectGradeParser $subjectGradeParser)
    {
        $id = $tokenStorage->getToken()->getUser()->getId();
        $subjects = $subjectGradeParser->gradesToSubjectGrades($id);
        // replace this example code with whatever you need
        return $this->render(
            'Student/student_grades.html.twig',
            [
                'subjects' => $subjects
            ]
        );
    }
}
