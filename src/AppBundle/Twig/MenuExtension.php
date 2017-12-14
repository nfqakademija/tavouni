<?php

namespace AppBundle\Twig;

use AppBundle\Entity\User;
use AppBundle\Repository\LectureRepository;
use AppBundle\Repository\PostRepository;
use AppBundle\ValueObject\MenuChild;
use AppBundle\ValueObject\MenuItem;
use Twig\Environment;

class MenuExtension extends \Twig_Extension
{
    /**
     * @var LectureRepository
     */
    private $lectureRepository;

    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * MenuExtension constructor.
     *
     * @param LectureRepository $lectureRepository
     * @param PostRepository $postRepository
     */
    public function __construct(LectureRepository $lectureRepository, PostRepository $postRepository)
    {
        $this->lectureRepository = $lectureRepository;
        $this->postRepository = $postRepository;
    }

    public function getFunctions(): array
    {
        return array(
            new \Twig_Function(
                'menu',
                [$this, 'renderMenu'],
                array('is_safe' => array('html'), 'needs_environment' => true)
            ),
        );
    }

    public function renderMenu(Environment $env, User $user, string $route): string
    {
        if ($user->hasRole('ROLE_STUDENT')) {
            $menuItems = [
                new MenuItem(
                    'student_index',
                    'Pagrindinis'
                ),
                new MenuItem(
                    'student_timetable',
                    'Tvarkaraštis'
                ),
                new MenuItem(
                    'student_grades',
                    'Pažymiai'
                )
            ];

            return $env->render(
                'menu.html.twig',
                [
                    'menuItems' => $menuItems,
                    'active' => $route,
                    'count' => $this->calculateUnseenCount($user)
                ]
            );
        }

        if ($user->hasRole('ROLE_LECTURER')) {
            $lectures = $this->lectureRepository->getLecturesForLecturer($user->getId());
            $lectureItems = [];
            foreach ($lectures as $lecture) {
                $lectureItems[] = new MenuChild(
                    $lecture->getSubject()->getName().' - '.$lecture->getLectureType()->getName(),
                    'lecture_id',
                    $lecture->getId()
                );
            }
            $menuItems = [
                new MenuItem(
                    'lecturer_index',
                    'Pagrindinis'
                ),
                new MenuItem(
                    'lecturer_show_posts',
                    'Dėstomi dalykai',
                    $lectureItems
                )
            ];

            return $env->render(
                'menu.html.twig',
                [
                    'menuItems' => $menuItems,
                    'active' => $route,
                    'count' => 0
                ]
            );
        }
    }

    private function calculateUnseenCount(User $user): int
    {
        $posts = $this->postRepository->getPostsForStudent($user->getId());

        $count = 0;
        foreach ($posts as $post) {
            if (!$post->getSeenByStudents()->contains($user->getStudent())) {
                $count++;
            }
        }

        return $count;
    }
}
