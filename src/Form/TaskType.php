<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class TaskType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('title', TextType::class, array(
			'label' => 'Título',
			'attr' => array('autofocus' => true),
			'required' => false
		))
		->add('content', TextareaType::class, array(
			'label' => 'Descripción',
			'required' => false
		))
		->add('priority', ChoiceType::class, array(
			'label' => 'Prioridad',
			'choices' => array(
				'Alta' => 'alta',
				'Media' => 'media',
				'Baja' => 'baja'
			),
			'required' => false
		))
		->add('hours', NumberType::class, array(
			'label' => 'Horas presupuestadas',
			'required' => false
		))
		->add('submit', SubmitType::class, array(
			'label' => 'Guardar'
		));
	}
}