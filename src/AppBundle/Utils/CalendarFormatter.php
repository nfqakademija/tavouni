<?php
/**
 * Created by PhpStorm.
 * User: aurimas
 * Date: 17.11.6
 * Time: 21.04
 */
namespace AppBundle\Utils;

use Sabre\VObject;

class CalendarFormatter
{
    /**
     * @param array $calendarDates
     * @return string
     */
    public function generateStudentVCalendarContent($calendarDates)
    {
        $vCalendar = $this->generateVCalendar($calendarDates, true);
        return $vCalendar->serialize();
    }

    public function generateLecturerVCalendarContent($calendarDates)
    {
        $vCalendar = $this->generateVCalendar($calendarDates, false);
        return $vCalendar->serialize();
    }

    /**
     * @param array $calendarDates
     * @return VObject\Component\VCalendar
     */
    private function generateVCalendar($calendarDates, bool $addLecturerName)
    {
        $vCalendar = new VObject\Component\VCalendar();
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
