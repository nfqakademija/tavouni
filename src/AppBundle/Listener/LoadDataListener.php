<?php

namespace AppBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\Event;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use AppBundle\Entity\AssignmentEvent;
use AppBundle\Repository\AssignmentEventRepository;
use AppBundle\Repository\LectureDateRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class LoadDataListener
{
    /**
     * @var EntityManager
     */
    private $ldRepository;
    private $tokenStorage;
    private $aeRepository;

    public function __construct(
        LectureDateRepository $ldRepository,
        TokenStorage $tokenStorage,
        AssignmentEventRepository $assignmentEventRepository
    ) {
        $this->ldRepository = $ldRepository;
        $this->tokenStorage = $tokenStorage;
        $this->aeRepository = $assignmentEventRepository;
    }
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(CalendarEvent $calendarEvent)
    {
        if ($this->tokenStorage->getToken()->getUser()->hasRole('ROLE_STUDENT')) {
            $userId = $this->tokenStorage->getToken()->getUser()->getId();
            $studentLectures = $this->ldRepository->getLectureDatesByStudent($userId);
            $assignmentEvents = $this->aeRepository->getAssignmentEventsForStudent($userId);
            foreach ($studentLectures as $lecture) {
                $data = $lecture->getLecture()->getSubject()->getName()." - ".
                    $lecture->getLecture()->getLectureType()->getName()."\n".
                    $lecture->getLecture()->getLecturer()->getName()."\n".
                    $lecture->getLecture()->getRoom()->getNo()."(".
                    $lecture->getLecture()->getRoom()->getBuilding()->getName().")"
                ;
                $event = new Event($data, $lecture->getStart());
                $event->setEndDate($lecture->getEnd());
                $event->setAllDay(false);
                $calendarEvent->addEvent($event);
            }
            foreach ($assignmentEvents as $assignment) {
                $data = $assignment->getAssignment()->getName()."\n".
                    $assignment->getAssignment()->getSubject()->getName()."\n".
                    $assignment->getAssignment()->getSubject()->getCoordinator()->getName()."\n".
                    $assignment->getRoom()->getNo().'('.
                    $assignment->getRoom()->getBuilding()->getName().')';
                $event = new Event($data, $assignment->getStart());
                $event->setEndDate($assignment->getEnd());
                $event->setAllDay(false);
                $event->setBackgroundColor('Tomato');
                $calendarEvent->addEvent($event);
            }
        }
        if ($this->tokenStorage->getToken()->getUser()->hasRole('ROLE_LECTURER')) {
            $userId = $this->tokenStorage->getToken()->getUser()->getId();
            $studentLectures = $this->ldRepository->getLectureDatesByLecturer($userId);
            foreach ($studentLectures as $lecture) {
                $data = $lecture->getLecture()->getSubject()->getName()." - ".
                    $lecture->getLecture()->getLectureType()->getName()."\n".
                    $lecture->getLecture()->getRoom()->getNo()."(".
                    $lecture->getLecture()->getRoom()->getBuilding()->getName().")"
                ;

                $event = new Event($data, $lecture->getStart());
                $event->setUrl('/lecturer/'.$lecture->getLecture()->getSubject()->getId().'/posts');
                $event->setEndDate($lecture->getEnd());
                $event->setAllDay(false);
                $calendarEvent->addEvent($event);
            }
        }
    }
}
