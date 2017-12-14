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
use AppBundle\Repository\AssignmentRepository;
use AppBundle\Repository\PostRepository;
use AppBundle\Utils\AssignmentsGroupFactory;
use AppBundle\Utils\SubjectGradeParser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    public function indexAction(
        TokenStorage $tokenStorage,
        PostRepository $postRepository,
        AssignmentRepository $assignmentRepository,
        AssignmentsGroupFactory $assignmentsGroupFactory
    ): Response {
    
        $id = $tokenStorage->getToken()->getUser()->getId();
        $posts = $postRepository->getPostsForStudent($id);
        $assignments = $assignmentRepository->getAssignmentsByStudent($id);
        $assignmentsGroups = $assignmentsGroupFactory->createAssignmentsGroupCollection($assignments);
        // replace this example code with whatever you need
        return $this->render(
            'Student/student_homepage.html.twig',
            [
                'posts' => $posts,
                'assignmentsGroups' => $assignmentsGroups
            ]
        );
    }

    /**
     * @Route("/timetable", name="student_timetable")
     */
    public function timetableAction(): Response
    {
        // replace this example code with whatever you need
        return $this->render(
            'Student/Timetable/student_calendar.html.twig'
        );
    }

    /**
     * @Route("/set-post-seen/{id}", name="student_post_seen")
     */
    public function postSeenAction(Post $post): Response
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
    public function gradesAction(
        TokenStorage $tokenStorage,
        SubjectGradeParser $subjectGradeParser
    ): Response {
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
