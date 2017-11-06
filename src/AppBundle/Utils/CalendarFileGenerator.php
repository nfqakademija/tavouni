<?php
/**
 * Created by PhpStorm.
 * User: aurimas
 * Date: 17.11.6
 * Time: 21.04
 */
namespace AppBundle\Utils;

use Sabre\VObject;

class CalendarFileGenerator
{
    public function generateFile($calendarDates)
    {
        /** @var array $calendarDates */
        $vcalendar = $this->generateVCalendar($calendarDates);
        $fileName = 'test.ics';
        $file = fopen('downloads/' . $fileName, "w");
        fwrite($file, $vcalendar->serialize());
        fclose($file);
        return $fileName;
    }

    private function generateVCalendar($calendarDates)
    {
        /** @var array $calendarDates */
        $vcalendar = new VObject\Component\VCalendar();
        foreach($calendarDates as $calendarDate) {
            $vcalendar->add(
                'VEVENT', [
                    'SUMMARY' => $calendarDate->getLecture()->getSubject()->getName(),
                    'DESCRIPTION' => $calendarDate->getLecture()->getLectureType() . "\n"
                        . $calendarDate->getLecture()->getLecturer()->getName()."\n"
                        . $calendarDate->getLecture()->getRoom()->getBuilding()->getName(),
                    'DTSTART' => $calendarDate->getStart(),
                    'DTEND'   => $calendarDate->getEnd()
                ]
            );
        }
        return $vcalendar;
    }
}
