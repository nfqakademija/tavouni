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
     * @Route("/timetable/download", name="student_calendar_download")
     */
    public function downloadAction(CalendarFormatter $iCalFormatter, LectureDateRepository $ldRepository)
    {
        $lectureDates = $ldRepository->getLectureDatesByUser($this->getUser()->getId());

        $response = new Response();
        $response->headers->set('Content-Type', 'text/calendar');
        $response->headers->set('Content-Disposition', 'attachment;filename=calendar.ics');
        $response->setContent($iCalFormatter->generateContent($lectureDates));

        return $response;
    }
}
