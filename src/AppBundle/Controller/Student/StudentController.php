<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.18
 * Time: 13.48
 */

namespace AppBundle\Controller\Student;

use AppBundle\Entity\SubjectGrades;
use AppBundle\Repository\GradeRepository;
use AppBundle\Repository\PostRepository;
use Sabre\VObject\Parser\Json;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    /**
     * @Route("/set_post_seen", name="student_post_seen")
     */
    public function postSeenAction(Request $request, PostRepository $postRepository)
    {
        if ($this->isGranted('ROLE_STUDENT')) {
            //echo $request->get('post_id');
            $postId = $request->get('post_id');
            $post = $postRepository->find((int)$postId);

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
    public function gradesAction(Request $request, TokenStorage $tokenStorage, GradeRepository $gradeRepository)
    {
        $id = $tokenStorage->getToken()->getUser()->getId();
        $grades = $gradeRepository->getStudentGrades($id);
        $subjects = [];
        //$subject = new SubjectGrades();
        foreach($grades as $grade) {
            $found = false;
            foreach($subjects as $subject) {
                if ($grade->getAssignment()->getSubject()->getName() === $subject->getName()) {
                    $subject->addGrade($grade);
                    $found = true;
                }
            }
            if (!$found) {
                $subject = new SubjectGrades();
                $subject->setName($grade->getAssignment()->getSubject()->getName());
                $subject->setId($grade->getAssignment()->getSubject()->getId());
                $subject->addGrade($grade);
                $subjects[] = $subject;
            }
        }
        // replace this example code with whatever you need
        return $this->render(
            'Student/student_grades.html.twig', [
                'subjects' => $subjects
            ]
        );
    }
}