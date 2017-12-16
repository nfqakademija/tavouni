<?php

namespace AppBundle\Utils;

use Sabre\VObject\Component\VCalendar;

class VCalendarGenerator
{
    /**
     * @param array $calendarDates
     * @param bool $addLecturerName
     *
     * @return string
     */
    public function generateVCalendarContent(array $calendarDates, bool $addLecturerName): string
    {
        $vCalendar = new VCalendar();
        foreach ($calendarDates as $calendarDate) {
            $vCalendar->add(
                'VEVENT',
                [
                    'SUMMARY' => $calendarDate->getLecture()->getSubject()->getName(),
                    'DESCRIPTION' => $calendarDate->getLecture()->getLectureType() . "\n"
                        . ($addLecturerName ? ($calendarDate->getLecture()->getLecturer()->getName() ."\n") : '')
                        . $calendarDate->getLecture()->getRoom()->getBuilding()->getName(),
                    'DTSTART' => $calendarDate->getStart(),
                    'DTEND'   => $calendarDate->getEnd()
                ]
            );
        }
        return $vCalendar->serialize();
    }
}
