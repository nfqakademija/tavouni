<?php

namespace AppBundle\Controller\Lecturer;

use AppBundle\Entity\Assignment;
use AppBundle\Entity\Grade;
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
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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
     * @Route("/grades", name="lecturer_grade_index")
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
    /**
     *
     * @Route("/grades/edit/{grade_id}/{value}", name="lecturer_edit_grade")
     * @Method({"GET", "POST"})
     * @ParamConverter("grade", options={"mapping": {"grade_id" : "id"}})
     */
    public function editAction(Lecture $lecture, Grade $grade, int $value, TokenStorage $tokenStorage)
    {
        $id = $tokenStorage->getToken()->getUser()->getId();
        if ($this->isGranted('ROLE_LECTURER') && $lecture->getLecturer()->getUser()->getId() === $id) {
            if ($grade === null || !($value >= 0 && $value <= 10)) {
                return new Response(null, Response::HTTP_NOT_FOUND);
            }
            $grade->setValue($value);
            $this->getDoctrine()->getManager()->flush();
            return new Response(null, Response::HTTP_OK);
        }
        return new Response(null, Response::HTTP_FORBIDDEN);
    }
}
