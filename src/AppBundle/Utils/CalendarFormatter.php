<?php

namespace AppBundle\Utils;

use Sabre\VObject\Component\VCalendar;

class CalendarFormatter
{
    /**
     * @param array $calendarDates
     * @return string
     */
    public function generateStudentVCalendarContent(array $calendarDates): string
    {
        $vCalendar = $this->generateVCalendar($calendarDates, true);

        return $vCalendar->serialize();
    }

    /**
     * @param array $calendarDates
     * @return string
     */
    public function generateLecturerVCalendarContent(array $calendarDates): string
    {
        $vCalendar = $this->generateVCalendar($calendarDates, false);

        return $vCalendar->serialize();
    }

    /**
     * @param array $calendarDates
     * @param bool $addLecturerName
     * @return VCalendar
     */
    private function generateVCalendar(array $calendarDates, bool $addLecturerName): VCalendar
    {
        $vCalendar = new VCalendar();
        foreach ($calendarDates as $calendarDate) {
            $vCalendar->add(
                'VEVENT',
                [
                    'SUMMARY' => $calendarDate->getLecture()->getSubject()->getName(),
                    'DESCRIPTION' => $calendarDate->getLecture()->getLectureType()->getName() . "\n"
                        . ($addLecturerName ? ($calendarDate->getLecture()->getLecturer()->getName()."\n") : '')
                        . $calendarDate->getLecture()->getRoom()->getBuilding()->getName(),
                    'DTSTART' => $calendarDate->getStart(),
                    'DTEND'   => $calendarDate->getEnd()
                ]
            );
        }

        return $vCalendar;
    }
}
