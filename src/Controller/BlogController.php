<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $query = $repository->createQueryBuilder('p')
            ->select(['p.title','p.id','p.shortcontent','p.date'])
            ->orderBy('p.id', 'ASC');

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );
        return $this->render('blog/index.html.twig', array('pagination' => $pagination));
    }
}
