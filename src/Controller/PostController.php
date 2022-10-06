<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(
        EntityManagerInterface $entityManager
    ): Response {
        $post = new Post();
        $post->setDatePublication(new \DateTime());
        $post->setMessage('Un message ici...');
        $post->setTitre('Hello World');

        $entityManager->persist($post);
        $entityManager->flush();

        /*
         * Version possible avant 6.0
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();
        */

        return $this->render('post/index.html.twig', [
            'post' => $post
        ]);
    }

    #[Route('/posts', name: 'app_posts')]
    public function listePosts(
        PostRepository $postRepository
    )
    {
        $posts = $postRepository->findAll();

        return $this->render('post/listePosts.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/edit-post/{id}', name: 'app_post_edit')]
    public function editPost(
        EntityManagerInterface $entityManager,
        PostRepository $postRepository,
        Post $id
    )
    {
        // $post = $postRepository->find($id); Pas nécessaire, avec la ligne Post $id
        $date = new \DateTime('now');
        $id->setTitre('Modifié le '.$date->format('H:i:s'));

        $entityManager->flush();

        return $this->redirectToRoute('app_posts');
    }

    #[Route('/delete-post/{id}', name: 'app_post_delete')]
public function deletePost(
        EntityManagerInterface $entityManager,
        Post $id
    )
    {
        $entityManager->remove($id);
        $entityManager->flush();

        return $this->redirectToRoute('app_posts');
    }
}
