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
    private $em;
    private $tokenStorage;

    public function __construct(EntityManager $em, TokenStorage $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(CalendarEvent $calendarEvent)
    {
        $user = $this->tokenStorage->getToken()->getUser()->getId();
        $studentLectures = $this->em->getRepository('AppBundle\Entity\LectureDate')->getLectureDatesByUser($user);
        foreach($studentLectures as $lecture)
        {
            $data = "\n".$lecture->getLecture()->getSubject()->getName()."\n".
                $lecture->getLecture()->getLectureType()."\n".
                $lecture->getLecture()->getLecturer()->getName()."\n".
                $lecture->getLecture()->getRoom()->getBuilding()->getName()
            ;
            $event = new Event($data, $lecture->getStart());
            $event->setEndDate($lecture->getEnd());
            $event->setAllDay(false);
            $calendarEvent->addEvent($event);
        }
    }
}