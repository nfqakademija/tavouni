<?php

namespace AppBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\Event;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use AppBundle\Entity\Group;
use AppBundle\Entity\Lecture;
use AppBundle\Entity\LectureDate;
use AppBundle\Entity\Lecturer;
use AppBundle\Entity\Room;
use AppBundle\Entity\Student;
use AppBundle\Entity\Subject;
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

    public function __construct(LectureDateRepository $ldRepository, TokenStorage $tokenStorage)
    {
        $this->ldRepository = $ldRepository;
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(CalendarEvent $calendarEvent)
    {
        $userId = $this->tokenStorage->getToken()->getUser()->getId();
        $studentLectures = $this->ldRepository->getLectureDatesByUser($userId);
        foreach ($studentLectures as $lecture) {
            $data = $lecture->getLecture()->getSubject()->getName()." - ".
                $lecture->getLecture()->getLectureType()."\n".
                $lecture->getLecture()->getLecturer()->getName()."\n".
                $lecture->getLecture()->getRoom()->getNo()."(".
                $lecture->getLecture()->getRoom()->getBuilding()->getName().")"
            ;
            $event = new Event($data, $lecture->getStart());
            $event->setEndDate($lecture->getEnd());
            $event->setAllDay(false);
            $calendarEvent->addEvent($event);
        }
    }
}
