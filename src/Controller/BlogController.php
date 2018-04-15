<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use App\Repository\PostRepository;
use App\Entity\Post;

class BlogController extends AbstractController
{
    /**
     * @Route("/", defaults={"page": "1"}, name="blog_index")
     * @Route("/page/{page}", requirements={"page": "[1-9]\d*"}, name="blog_index_paginated")
     * @Method("GET")
     */
    public function index($page, PostRepository $postRepository): Response
    {
    	$posts = $postRepository->findLatest($page);

        return $this->render('blog/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/posts/{slug}", name="blog_show_post")
     * @Method("GET")
     */
    public function showPost(Post $post): Response
    {
        return $this->render('blog/showPost.html.twig', [
            'post' => $post
        ]);
    }
}
