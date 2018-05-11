<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Tag;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller {

	public function index(Request $request, PostRepository $posts, TagRepository $tags) {

		$latestPosts = $posts->findPosts();

		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$latestPosts, /* query NOT result */
			$request->query->getInt('page', 1) /*page number*/,
			2/*limit per page*/
		);

		$tags = $tags->findTags();

		return $this->render('blog/index.html.twig', array('pagination' => $pagination, 'tags' => $tags));
	}

	//==========================================================================================================
	public function showPost(Post $post) {

		return $this->render('blog/show_post.html.twig', ['post' => $post]);
	}

	public function showByTag(Request $request, Tag $tag, PostRepository $posts, TagRepository $tags) {

		$postsByTag = $posts->findPostsByTag($tag);

		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$postsByTag, /* query NOT result */
			$request->query->getInt('page', 1) /*page number*/,
			2/*limit per page*/
		);

		$tags = $tags->findTags();
		return $this->render('blog/index.html.twig', array('pagination' => $pagination, 'tags' => $tags));

	}

}
