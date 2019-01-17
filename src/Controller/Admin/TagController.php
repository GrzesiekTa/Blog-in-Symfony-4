<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\TagType;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller {

    /**
     * tag list
     * 
     * @return Response
     */
    public function list(): Response {
        $category = $this->getDoctrine()->getRepository(Tag::class)->findAll();
        return $this->render('tag/list.html.twig', [
                    'category' => $category,
        ]);
    }

    /**
     * edit tag
     * 
     * @param Request $request
     * @param type $id
     * 
     * @return Response
     */
    public function edit(Request $request, $id): Response {
        $category = $this->getDoctrine()->getRepository(Tag::class)->find($id);
        $form = $this->createForm(TagType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $slugify = new Slugify;

            $tag = $form->getData();

            $tag->setSlug($slugify->slugify($tag->getName()));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tag);
            $entityManager->flush();
        }

        return $this->render('tag/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * adding tag
     * 
     * @param Request $request
     * 
     * @return Response
     */
    public function add(Request $request): Response {
        $form = $this->createForm(TagType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $slugify = new Slugify;

            $tag = $form->getData();

            $tag->setSlug($slugify->slugify($tag->getName()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tag);
            $entityManager->flush();
            
            return $this->redirectToRoute('blog_category');
        }

        return $this->render('tag/add.html.twig', array('form' => $form->createView()));
    }

}
