<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(
        EntityManagerInterface $entityManager
    ): Response
    {
        $post = new Post();
        $post->setTitre('Titre');
        $post->setMessage('Message');
        $post->setDatePublication(new \DateTime());

        $entityManager->persist($post);
        $entityManager->flush();


        return $this->render('post/index.html.twig', [
            'post' => $post,
        ]);
    }
}
