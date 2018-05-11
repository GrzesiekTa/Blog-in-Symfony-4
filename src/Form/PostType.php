<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('title', TextType::class, array('attr' => array('class' => 'form-control')))

			->add('content', TextareaType::class, array(
				'required' => false,
				'attr' => array('class' => 'form-control'),
			))

			->add('shortcontent', TextareaType::class, array('attr' => array('class' => 'form-control')))
			->add('publishedAt', DateTimeType::class, array('attr' => array('class' => 'form-control')))
			->add('headtitle', TextType::class, array('attr' => array('class' => 'form-control')))
			->add('keyworks', TextareaType::class, array('attr' => array('class' => 'form-control')))
			->add('description', TextareaType::class, array('attr' => array('class' => 'form-control')))

			->add('tags', EntityType::class, array(
				'class' => Tag::class,
				'choice_label' => 'name',
				'multiple' => true,
				'expanded' => true,
			))

			->add('save', SubmitType::class, array(
				'label' => 'Zapisz',
				'attr' => array('class' => 'btn btn-primary mt-3'),
			))
		;
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
			'data_class' => Post::class,
		]);
	}
}
