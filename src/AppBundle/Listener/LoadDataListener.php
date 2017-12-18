<?php

namespace AppBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\Event;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
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

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var AssignmentEventRepository
     */
    private $aeRepository;

    /**
     * LoadDataListener constructor.
     *
     * @param LectureDateRepository $ldRepository
     * @param TokenStorage $tokenStorage
     * @param AssignmentEventRepository $aeRepository
     */
    public function __construct(
        LectureDateRepository $ldRepository,
        TokenStorage $tokenStorage,
        AssignmentEventRepository $aeRepository
    ) {
        $this->ldRepository = $ldRepository;
        $this->tokenStorage = $tokenStorage;
        $this->aeRepository = $aeRepository;
    }

    /**
     * @param CalendarEvent $calendarEvent
     */
    public function loadData(CalendarEvent $calendarEvent)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        if ($user->hasRole('ROLE_STUDENT')) {
            $userId = $user->getId();
            $studentLectures = $this->ldRepository->getLectureDatesByStudent($userId);
            $assignmentEvents = $this->aeRepository->getAssignmentEventsForStudent($userId);
            $this->addCalendarEvents($studentLectures, $calendarEvent, true);
            $this->addAssignmentEvents($assignmentEvents, $calendarEvent, true);
        }
        if ($user->hasRole('ROLE_LECTURER')) {
            $userId = $user->getId();
            $lectures = $this->ldRepository->getLectureDatesByLecturer($userId);
            $assignmentEvents = $this->aeRepository->getAssignmentEventsForLecturer($userId);
            $this->addCalendarEvents($lectures, $calendarEvent, false);
            $this->addAssignmentEvents($assignmentEvents, $calendarEvent, false);
        }
    }

    private function addCalendarEvents(array $lectures, CalendarEvent $calendarEvent, bool $isStudent): CalendarEvent
    {
        foreach ($lectures as $lecture) {
            $data = $lecture->getLecture()->getSubject()->getName() . ' - ' .
                $lecture->getLecture()->getLectureType() . "\n" .
                ($isStudent ? ($lecture->getLecture()->getLecturer()->getName() . "\n") : '') .
                $lecture->getLecture()->getRoom()->getNo() . '(' .
                $lecture->getLecture()->getRoom()->getBuilding()->getName() . ')'
            ;
            $event = new Event($data, $lecture->getStart());
            if (!$isStudent) {
                $event->setUrl('/lecturer/lecture/'.$lecture->getLecture()->getSubject()->getId() . '/posts');
            }
            $event->setEndDate($lecture->getEnd());
            $event->setAllDay(false);
            $calendarEvent->addEvent($event);
        }

        return $calendarEvent;
    }

    private function addAssignmentEvents(
        array $assignmentEvents,
        CalendarEvent $calendarEvent,
        bool $isStudent
    ): CalendarEvent {
        foreach ($assignmentEvents as $assignment) {
            $data = $assignment->getAssignment()->getName() . "\n" .
                $assignment->getAssignment()->getSubject()->getName() . "\n" .
                ($isStudent ? ($assignment->getAssignment()->getSubject()->getCoordinator()->getName() . "\n") : '') .
                $assignment->getRoom()->getNo() . '(' .
                $assignment->getRoom()->getBuilding()->getName() . ')';
            $event = new Event($data, $assignment->getStart());
            $event->setEndDate($assignment->getEnd());
            $event->setAllDay(false);
            $event->setBackgroundColor('Tomato');
            $calendarEvent->addEvent($event);
        }

        return $calendarEvent;
    }
}
