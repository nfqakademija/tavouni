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
        $date = new \DateTime();
        $date->setDate(2017, 11, 06);
        $date->setTime(12, 0);
        $date2 = new \DateTime();
        $date2->setDate(2017, 11, 06);
        $date2->setTime(14, 0);
        $user = $this->tokenStorage->getToken()->getUser()->getId();
        $studentLectures = $this->em->getRepository('AppBundle\Entity\LectureDate')->getLectureDatesByUser($user);
        foreach($studentLectures as $lecture)
        {
            $data = "\n".$lecture->getLecture()->getSubject()->getName()."\n".$lecture->getLecture()->getSubject()->getSubjectType()."\n".$lecture->getLecture()->getLecturer()->getName();
            $event = new Event($data, $lecture->getDate());
            $event->setEndDate($date2);
            $event->setAllDay(false);
            $calendarEvent->addEvent($event);
        }
    }
}