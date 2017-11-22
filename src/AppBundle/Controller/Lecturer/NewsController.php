<?php

namespace AppBundle\Controller\Lecturer;

use AppBundle\Entity\Post;
use AppBundle\Entity\Subject;
use AppBundle\Form\PostType;
use AppBundle\Repository\LecturerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/lecturer/{subject_id}")
 * @ParamConverter("subject", options={"mapping": {"subject_id" : "id"}})
 */
class NewsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/posts", name="lecturer_show_posts")
     */
    public function showPostsAction(Subject $subject)
    {
        return $this->render(':Lecturer/News:show_posts.html.twig');
    }

    /**
     * @Route("/posts/new", name="lecturer_add_post")
     */
    public function addPostAction(Request $request, Subject $subject)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $post->setSubject($subject);
            $post->setAuthor($this->getUser()->getLecturer());
            $post->setPublishedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        return $this->render(
            ':Lecturer/News:add_post.html.twig',
            [
                'postForm' => $form->createView()
            ]
        );
    }
}
