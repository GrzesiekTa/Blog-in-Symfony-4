<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Form\TagType;
use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller {
	public function list() {
		$category = $this->getDoctrine()->getRepository(Tag::class)->findAll();
		return $this->render('tag/list.html.twig', [
			'category' => $category,
		]);
	}

	public function edit(Request $request, $id) {
		$category = $this->getDoctrine()->getRepository(Tag::class)->find($id);
		$form = $this->createForm(TagType::class, $category);
		$form->handleRequest($request);
		//=========================================================================================
		if ($form->isSubmitted() && $form->isValid()) {

			$slugify = new Slugify;

			$tag = $form->getData();

			$tag->setSlug($slugify->slugify($tag->getName()));

			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($tag);
			$entityManager->flush();
		}
		//=========================================================================================
		return $this->render('tag/edit.html.twig', array('form' => $form->createView()));
	}

	public function add(Request $request) {
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
