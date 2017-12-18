<?php

namespace AppBundle\Controller\Lecturer;

use AppBundle\Entity\Lecture;
use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use AppBundle\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/lecturer/lecture/{lecture_id}")
 * @ParamConverter("lecture", options={"mapping": {"lecture_id" : "id"}})
 */
class NewsController extends Controller
{
    /**
     * @Route("/posts", name="lecturer_show_posts")
     */
    public function showPostsAction(
        Lecture $lecture,
        PostRepository $postRepository
    ): Response {
        $posts = $postRepository->getLecturePosts($lecture->getId());

        return $this->render(':Lecturer/News:show_posts.html.twig', [
            'posts' => $posts,
            'lecture_id' =>$lecture->getId(),
            'subject_id' => $lecture->getSubject()->getId(),
        ]);
    }

    /**
     * @Route("/posts/new", name="lecturer_add_post")
     */
    public function addPostAction(Request $request, Lecture $lecture): Response
    {
        $form = $this->createForm(PostType::class, null, [
            'lecture' => $lecture,
            'author' => $this->getUser()->getLecturer()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('lecturer_show_posts', ['lecture_id'=>$lecture->getId()]);
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
    public function deletePostAction(Post $post, Lecture $lecture): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('lecturer_show_posts', ['lecture_id'=>$lecture->getId()]);
    }

    /**
     *
     * @Route("/posts/{post_id}/edit", requirements={"id": "\d+"}, name="lecturer_edit_post")
     * @Method({"GET", "POST"})
     * @ParamConverter("post", options={"mapping": {"post_id" : "id"}})
     */
    public function editAction(Request $request, Post $post, Lecture $lecture): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lecturer_show_posts', ['lecture_id'=>$lecture->getId()]);
        }

        return $this->render(':Lecturer/News:add_post.html.twig', [
            'postForm' => $form->createView(),
        ]);
    }
}
