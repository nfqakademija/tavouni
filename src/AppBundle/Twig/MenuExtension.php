<?php

namespace AppBundle\Twig;

use AppBundle\Entity\User;
use AppBundle\Repository\LectureRepository;
use AppBundle\Repository\PostRepository;
use AppBundle\ValueObject\MenuItem;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @param LectureRepository $lectureRepository
     * @param PostRepository $postRepository
     * @param UrlGeneratorInterface $router
     */
    public function __construct(
        LectureRepository $lectureRepository,
        PostRepository $postRepository,
        UrlGeneratorInterface $router
    ) {
        $this->lectureRepository = $lectureRepository;
        $this->postRepository = $postRepository;
        $this->router = $router;
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
                    $this->router->generate('student_index'),
                    'Pagrindinis'
                ),
                new MenuItem(
                    $this->router->generate('student_timetable'),
                    'Tvarkaraštis'
                ),
                new MenuItem(
                    $this->router->generate('student_grades'),
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
                $lectureItems[] = new MenuItem(
                    $this->router->generate('lecturer_show_posts', ['lecture_id' => $lecture->getId()]),
                    $lecture->getSubject()->getName() . ' - ' . $lecture->getLectureType() . ' ' .
                    ($lecture->getLectureType() !== 'Teorija' ? $lecture->getGroup()->getNumber() . ' grupė' : '')
                );
            }
            $menuItems = [
                new MenuItem(
                    $this->router->generate('lecturer_index'),
                    'Pagrindinis'
                ),
                new MenuItem(
                    $this->router->generate('lecturer_index'),
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
