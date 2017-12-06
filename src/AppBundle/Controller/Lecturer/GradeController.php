<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.12.6
 * Time: 22.02
 */

namespace AppBundle\Controller\Lecturer;

use AppBundle\Datatables\AssignmentDatatable;
use AppBundle\Entity\Assignment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sg\DatatablesBundle\Datatable\DatatableInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/lecturer/lecture/{lecture_id}")
 * @ParamConverter("lecture", options={"mapping": {"lecture_id" : "id"}})
 */
class GradeController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @param Request $request
     *
     * @Route("/grades", name="post_index")
     * @Method("GET")
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $isAjax = $request->isXmlHttpRequest();

        // Get your Datatable ...
        //$datatable = $this->get('app.datatable.post');
        //$datatable->buildDatatable();

        // or use the DatatableFactory
        /** @var DatatableInterface $datatable */
        $datatable = $this->get('sg_datatables.factory')->create(AssignmentDatatable::class);
        $datatable->buildDatatable();
        echo('asd');
        if ($isAjax) {
            $responseService = $this->get('sg_datatables.response');
            $responseService->setDatatable($datatable);
            $responseService->getDatatableQueryBuilder();

            return $responseService->getResponse();
        }

        return $this->render(':Lecturer/Grades:grade_index.html.twig', array(
            'datatable' => $datatable,
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     * @param Assignment $assignment
     *
     * @Route("/{_locale}/{id}.{_format}", name = "post_show", options = {"expose" = true})
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     *
     * @return Response
     */
    public function showAction(Assignment $assignment)
    {
        return $this->render('post/show.html.twig', array(
            'assignment' => $assignment,
        ));
    }
}