<?php

namespace AppBundle\Controller\Lecturer;

use AppBundle\Entity\Grade;
use AppBundle\Entity\Lecture;
use AppBundle\Repository\GradeRepository;
use AppBundle\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/grades", name="lecturer_grade_index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction(StudentRepository $studentRepository, Lecture $lecture): Response
    {
        $students = $studentRepository->getStudentsWithGradesByLecture($lecture->getId());

        return $this->render(':Lecturer/Grades:show_grades.html.twig', [
            'students' => $students
        ]);
    }

    /**
     * @Route("/grades/edit", name="lecturer_edit_grade")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Lecture $lecture, TokenStorage $tokenStorage): Response
    {
        $id = $tokenStorage->getToken()->getUser()->getId();
        if ($this->isGranted('ROLE_LECTURER') && $lecture->getLecturer()->getUser()->getId() === $id) {
            $content = $request->getContent();
            if (!empty($content)) {
                $json = json_decode($content);
                if ($json !== null) {
                    foreach ($json as $elem) {
                        $grade = $this->getDoctrine()->getRepository(Grade::class)->findOneBy(['id' => $elem->gradeId]);
                        $value = $elem->gradeValue;
                        if ($grade === null || !($value >= 0 && $value <= 10)) {
                            return new Response(null, Response::HTTP_BAD_REQUEST);
                        }
                        $grade->setValue($value);
                        $this->getDoctrine()->getManager()->flush();
                    }

                    return new JsonResponse(null, Response::HTTP_OK);
                }

                return new Response(null, Response::HTTP_BAD_REQUEST);
            }
        }

        return new Response(null, Response::HTTP_FORBIDDEN);
    }
}
