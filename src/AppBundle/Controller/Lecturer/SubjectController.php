<?php

namespace AppBundle\Controller\Lecturer;

use AppBundle\Entity\Grade;
use AppBundle\Entity\Subject;
use AppBundle\Form\AssignmentType;
use AppBundle\Repository\AssignmentRepository;
use AppBundle\Repository\BuildingRepository;
use AppBundle\Repository\RoomRepository;
use AppBundle\Repository\StudentRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function showAssignmentsAction(
        Subject $subject,
        AssignmentRepository $assignmentRepository
    ): Response {
        if ($this->getUser()->getId() !== $subject->getCoordinator()->getUser()->getId()) {
            return new Response(null, Response::HTTP_FORBIDDEN);
        }
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addRouteItem('Pagrindinis', 'lecturer_index');
        $breadcrumbs->addRouteItem($subject->getName(), 'lecturer_assignments', [
            'subject_id' => $subject->getId()
        ]);
        //$breadcrumbs->addItem('Atsiskaitymai');
        $assignments = $assignmentRepository->getSubjectAssignments($subject->getId());

        return $this->render('Lecturer/Subjects/show_subject_assignments.html.twig', [
            'subject' => $subject,
            'assignments' => $assignments,
        ]);
    }

    /**
     * @Route("/assignments/new", name="lecturer_new_assignment")
     */
    public function addAssignmentAction(
        Request $request,
        Subject $subject,
        RoomRepository $roomRepository,
        StudentRepository $studentRepository,
        BuildingRepository $buildingRepository
    ): Response {
        if ($this->getUser()->getId() !== $subject->getCoordinator()->getUser()->getId()) {
            return new Response(null, Response::HTTP_FORBIDDEN);
        }
        $breadcrumbs = $this->get('white_october_breadcrumbs');
        $breadcrumbs->addRouteItem('Pagrindinis', 'lecturer_index');
        $breadcrumbs->addRouteItem($subject->getName(), 'lecturer_assignments', [
            'subject_id' => $subject->getId()
        ]);
        //$breadcrumbs->addItem('Atsiskaitymai');
        $breadcrumbs->addItem('Naujas atsiskaitymas');
        $rooms = $roomRepository->findAll();
        $buildings = $buildingRepository->findAll();
        $form = $this->createForm(AssignmentType::class, null, [
            'subject' => $subject,
            'rooms' => $rooms,
            'buildings' => $buildings,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assignment = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($assignment);
            $students = $studentRepository->getSubjectStudents($assignment->getSubject()->getId());
            foreach ($students as $student) {
                $em->persist(new Grade(
                    $assignment,
                    $student,
                    0
                ));
            }
            $em->flush();

            return $this->redirectToRoute('lecturer_assignments', ['subject_id'=>$subject->getId()]);
        }

        return $this->render(
            'Lecturer/Subjects/add_subject_assignment.html.twig',
            [
                'postForm' => $form->createView(),
                'rooms' => $rooms,
                'buildings' => $buildings,
            ]
        );
    }
}
