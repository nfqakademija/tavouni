<?php

namespace AppBundle\Controller\Lecturer;

use AppBundle\Entity\Assignment;
use AppBundle\Entity\Lecture;
use AppBundle\Repository\AssignmentRepository;
use AppBundle\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/lecturer/lecture/{lecture_id}")
 * @ParamConverter("lecture", options={"mapping": {"lecture_id" : "id"}})
 */
class GradeController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @param Request $request
     *
     * @Route("/grades", name="post_index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction(Request $request, StudentRepository $studentRepository, Lecture $lecture)
    {
        $students = $studentRepository->getStudentsWithGradesByLecture($lecture->getId());

        dump($students);

        return $this->render(':Lecturer/Grades:show_grades.html.twig', [
            'students' => $students
        ]);
    }
}