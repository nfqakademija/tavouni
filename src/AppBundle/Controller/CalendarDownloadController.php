<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LectureDate;
use AppBundle\Utils\CalendarFormatter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CalendarDownloadController extends Controller
{
    /**
     * @Route("/calendar/download", name="download_calendar")
     */
    public function downloadAction(CalendarFormatter $iCalFormatter)
    {
        $ldRep = $this->getDoctrine()->getRepository(LectureDate::class);
        $lectureDates = $ldRep->getLectureDatesByUser($this->getUser()->getId());

        $response = new Response();
        $response->headers->set('Content-Type', 'text/calendar');
        $response->headers->set('Content-Disposition', 'attachment;filename=calendar.ics');
        $response->setContent($iCalFormatter->generateContent($lectureDates));

        return $response;
    }
}
