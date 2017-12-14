<?php

namespace AppBundle\Controller;

use AppBundle\Repository\LectureDateRepository;
use AppBundle\Utils\CalendarFormatter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CalendarDownloadController extends Controller
{
    /**
     * @Route("/timetable/download", name="calendar_download")
     */
    public function downloadAction(CalendarFormatter $iCalFormatter, LectureDateRepository $ldRepository): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/calendar');
        $response->headers->set('Content-Disposition', 'attachment;filename=calendar.ics');

        if ($this->isGranted('ROLE_STUDENT')) {
            $lectureDates = $ldRepository->getLectureDatesByStudent($this->getUser()->getId());
            $content = $iCalFormatter->generateStudentVCalendarContent($lectureDates);
            $response->setContent($content);

            return $response;
        }
        $lectureDates = $ldRepository->getLectureDatesByLecturer($this->getUser()->getId());
        $content = $iCalFormatter->generateLecturerVCalendarContent($lectureDates);
        $response->setContent($content);

        return $response;
    }
}
