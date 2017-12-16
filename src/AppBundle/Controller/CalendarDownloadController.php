<?php

namespace AppBundle\Controller;

use AppBundle\Repository\LectureDateRepository;
use AppBundle\Utils\VCalendarGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CalendarDownloadController extends Controller
{
    /**
     * @Route("/api/calendar", name="calendar_download")
     */
    public function downloadAction(
        VCalendarGenerator $vCalendarGenerator,
        LectureDateRepository $ldRepository
    ): Response {
        $response = new Response();
        $response->headers->set('Content-Type', 'text/calendar');
        $response->headers->set('Content-Disposition', 'attachment;filename=calendar.ics');

        if ($this->isGranted('ROLE_STUDENT')) {
            $lectureDates = $ldRepository->getLectureDatesByStudent($this->getUser()->getId());
        } elseif ($this->isGranted('ROLE_LECTURER')) {
            $lectureDates = $ldRepository->getLectureDatesByLecturer($this->getUser()->getId());
        }
        $content = $vCalendarGenerator->generateVCalendarContent($lectureDates, $this->isGranted('ROLE_STUDENT'));
        $response->setContent($content);

        return $response;
    }
}
