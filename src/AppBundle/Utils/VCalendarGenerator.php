<?php

namespace AppBundle\Utils;

use AppBundle\Entity\AssignmentEvent;
use Sabre\VObject\Component\VCalendar;
use AppBundle\Entity\LectureDate;

class VCalendarGenerator
{
    /**
     * @param array $lectureEvents
     * @param array $assignmentEvents
     * @param bool $forStudent
     *
     * @return string
     */
    public function generateVCalendarContent(array $lectureEvents, array $assignmentEvents, bool $forStudent): string
    {
        $vCalendar = new VCalendar();
        $vCalendar->add('X-WR-CALNAME', 'TavoUni events');
        $this->addLectureEvents($vCalendar, $lectureEvents, $forStudent);
        $this->addAssignmentEvents($vCalendar, $assignmentEvents, $forStudent);
        return $vCalendar->serialize();
    }

    private function addLectureEvents(VCalendar $vCalendar, array $lectureEvents, bool $addLecturerName): void
    {
        /** @var LectureDate $event */
        foreach ($lectureEvents as $event) {
            $vCalendar->add(
                'VEVENT',
                [
                    'SUMMARY' => $event->getLecture()->getSubject()->getName(),
                    'LOCATION' => $event->getLecture()->getRoom()->getBuilding()->getAddress(),
                    'DESCRIPTION' => $event->getLecture()->getLectureType() . "\n"
                        . ($addLecturerName ? ($event->getLecture()->getLecturer()->getName() . "\n") : '')
                        . $event->getLecture()->getRoom()->getNo() . ' ('
                        . $event->getLecture()->getRoom()->getBuilding()->getName() . ')',
                    'DTSTART' => $event->getStart(),
                    'DTEND' => $event->getEnd()
                ]
            );
        }
    }
    private function addAssignmentEvents(VCalendar $vCalendar, array $assignmentEvents, bool $addLecturerName): void
    {
        /** @var AssignmentEvent $event */
        foreach ($assignmentEvents as $event) {
            $vCalendar->add(
                'VEVENT',
                [
                    'SUMMARY' => $event->getAssignment()->getSubject()->getName(),
                    'LOCATION' => $event->getRoom()->getBuilding()->getAddress(),
                    'DESCRIPTION' => $event->getAssignment()->getName() . "\n"
                        . ($addLecturerName ?
                            ($event->getAssignment()->getSubject()->getCoordinator()->getName() . "\n") : '')
                        . $event->getRoom()->getNo() . ' ('
                        . $event->getRoom()->getBuilding()->getName() . ')',
                    'DTSTART' => $event->getStart(),
                    'DTEND' => $event->getEnd()
                ]
            );
        }
    }
}
