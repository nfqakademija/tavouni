<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.11.21
 * Time: 21.51
 */

namespace AppBundle\Twig;

use AppBundle\Entity\User;
use AppBundle\Repository\LectureRepository;
use Symfony\Component\Routing\Route;

class MenuExtension extends  \Twig_Extension
{
    private $twig;
    private $lectureRepository;

    /**
     * MenuExtension constructor.
     * @param $twig
     * @param $lectureRepository
     */
    public function __construct(\Twig_Environment $twig, LectureRepository $lectureRepository)
    {
        $this->twig = $twig;
        $this->lectureRepository = $lectureRepository;
    }


    public function getFunctions()
    {
        return array(
            new \Twig_Function('menu', [$this, 'renderMenu']),
        );
    }

    public function renderMenu(User $user, $route)
    {
        if ($user->hasRole('ROLE_STUDENT')) {
            return $this->twig->render(
                'Student/student_menu.html.twig', [
                    'navigation_bar' => [['student_index', 'Pagrindinis'], ['student_timetable', 'Tvarkaraštis']],
                    'active' => $route
                ]
            );
        }
        if ($user->hasRole('ROLE_LECTURER')) {
            $lectures = $this->lectureRepository->getLecturesForLecturer($user->getId());
            return $this->twig->render(
                'Lecturer/lecturer_menu.html.twig', [
                    'navigation_bar' => [['lecturer_index', 'Pagrindinis']],
                    'active' => $route,
                    'lectures' => $lectures
                ]
            );
        }
    }
}