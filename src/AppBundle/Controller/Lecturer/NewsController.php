<?php

namespace AppBundle\Controller\Lecturer;

use AppBundle\Entity\Post;
use AppBundle\Entity\Subject;
use AppBundle\Form\PostType;
use AppBundle\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

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
    public function showPostsAction(Subject $subject, TokenStorage $tokenStorage, PostRepository $postRepository)
    {
        $id = $tokenStorage->getToken()->getUser()->getId();
        $posts = $postRepository->getPostsByLecturer($id);
        return $this->render(':Lecturer/News:show_posts.html.twig', [
            'posts' => $posts,
            'subject_id' =>$subject->getId()
        ]);
    }

    /**
     * @Route("/posts/new", name="lecturer_add_post")
     */
    public function addPostAction(Request $request, Subject $subject)
    {
        $form = $this->createForm(PostType::class, null, [
            'subject' => $subject,
            'author' => $this->getUser()->getLecturer()
        ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute('lecturer_show_posts', ['subject_id'=>$subject->getId()]);
        }

        return $this->render(
            ':Lecturer/News:add_post.html.twig',
            [
                'postForm' => $form->createView()
            ]
        );
    }
    /**
     * @Route("/posts/{post_id}/delete", name="lecturer_delete_post")
     * @Method("POST")
     * @ParamConverter("post", options={"mapping": {"post_id" : "id"}})
     */
    public function deletePostAction(Request $request, Post $post, Subject $subject)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('lecturer_show_posts', ['subject_id'=>$subject->getId()]);
    }

    /**
     *
     * @Route("/posts/{post_id}/edit", requirements={"id": "\d+"}, name="lecturer_edit_post")
     * @Method({"GET", "POST"})
     * @ParamConverter("post", options={"mapping": {"post_id" : "id"}})
     */
    public function editAction(Request $request, Post $post, Subject $subject)
    {

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('lecturer_show_posts', ['subject_id'=>$subject->getId()]);
        }

        return $this->render(':Lecturer/News:add_post.html.twig', [
            'postForm' => $form->createView(),
        ]);
    }
}
