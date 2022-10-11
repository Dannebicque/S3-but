<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostCategoryRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        PostCategoryRepository $postCategoryRepository
    ): Response {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_posts');
        }

        return $this->render('post/index.html.twig', [
            'post' => $post,
            'form' => $form->createView()
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
