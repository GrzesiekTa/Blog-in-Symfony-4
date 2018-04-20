<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogCategoryController extends Controller
{
    /**
     * @Route("/blog/category", name="blog_category")
     */
    public function index()
    {
        return $this->render('blog_category/index.html.twig', [
            'controller_name' => 'BlogCategoryController',
        ]);
    }
}
