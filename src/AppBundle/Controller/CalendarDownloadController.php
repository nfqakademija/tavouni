<?php

namespace AppBundle\Controller;

use AppBundle\Entity\LectureDate;
use AppBundle\Utils\CalendarFileGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CalendarDownloadController extends Controller
{
    /**
     * @Route("/calendar/download", name="download_calendar")
     */
    public function downloadAction(CalendarFileGenerator $iCalFormatter)
    {
        $ldRep = $this->getDoctrine()->getRepository(LectureDate::class);
        $lectureDates = $ldRep->getLectureDatesByUser($this->getUser()->getId());

        $fileName = $iCalFormatter->generateFile($lectureDates);
        $response = new BinaryFileResponse('downloads/' . $fileName);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $fileName);
        return $response;
    }
}
