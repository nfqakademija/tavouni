<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.12.4
 * Time: 21.46
 */

namespace AppBundle\Controller\Lecturer;


use AppBundle\Entity\Subject;
use AppBundle\Form\AssignmentType;
use AppBundle\Repository\LectureTypeRepository;
use AppBundle\Repository\RoomRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lecturer/subject/{subject_id}")
 * @ParamConverter("subject", options={"mapping": {"subject_id" : "id"}})
 */
class SubjectController extends Controller
{
    /**
     * @Route("/assignments", name="lecturer_assignments")
     */
    public function showAssignmentsAction(Subject $subject)
    {
        return $this->render('Lecturer/Subjects/show_subject_assignments.html.twig', [
            'subject_id' => $subject->getId(),
        ]);
    }
    /**
     * @Route("/assignments/new", name="lecturer_new_assignment")
     */
    public function addAssignmentAction(
        Request $request,
        Subject $subject,
        LectureTypeRepository $lectureTypeRepository,
        RoomRepository $roomRepository
    ) {
        $lectureTypes = $lectureTypeRepository->findAll();
        $rooms = $roomRepository->findAll();
        $form = $this->createForm(AssignmentType::class, null, [
            'subject' => $subject,
            'lectureTypes' => $lectureTypes,
            'rooms' => $rooms,
        ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute('lecturer_assignments', ['subject_id'=>$subject->getId()]);
        }

        return $this->render(
            'Lecturer/Subjects/add_subject_assignment.html.twig',
            [
                'postForm' => $form->createView(),
                'rooms' => $rooms,
            ]
        );
    }
}