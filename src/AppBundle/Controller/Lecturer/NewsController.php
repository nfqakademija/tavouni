<?php

namespace AppBundle\Controller\Lecturer;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/lecturer/{subject}")
 */
class NewsController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route("/posts", name="lecturer_posts")
     */
    public function showPostsAction()
    {
        return $this->render(':Lecturer/News:show_posts.html.twig');
    }

    /**
     * @Route("/posts/new", name="lecturer_new_post")
     */
    public function addPostAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        

        return $this->render(':Lecturer/News:add_post.html.twig',
            [
                'postForm' => $form->createView()
            ]);
    }
}
