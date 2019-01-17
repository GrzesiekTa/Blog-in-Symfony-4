<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tag;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller {

    /**
     * 
     * @param Request $request
     * @param PostRepository $posts
     * @param TagRepository $tags
     * 
     * @return Response
     */
    public function index(Request $request, PostRepository $posts, TagRepository $tags): Response {

        $latestPosts = $posts->findPosts();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $latestPosts, /* query NOT result */
                $request->query->getInt('page', 1) /* page number */,
                2/* limit per page */
        );

        $tags = $tags->findTags();

        return $this->render('blog/index.html.twig', array('pagination' => $pagination, 'tags' => $tags));
    }

    /**
     * @param Post $post
     * @return Response
     */
    public function showPost(Post $post): Response {
        return $this->render('blog/show_post.html.twig', ['post' => $post]);
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @param PostRepository $posts
     * @param TagRepository $tags
     * @return Response
     */
    public function showByTag(Request $request, Tag $tag, PostRepository $posts, TagRepository $tags): Response {

        $postsByTag = $posts->findPostsByTag($tag);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $postsByTag, /* query NOT result */
                $request->query->getInt('page', 1) /* page number */,
                2/* limit per page */
        );

        $tags = $tags->findTags();

        return $this->render('blog/index.html.twig', array('pagination' => $pagination, 'tags' => $tags));
    }

}
