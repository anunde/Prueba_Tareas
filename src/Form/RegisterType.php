<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegisterType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('name', TextType::class, array(
			'label' => 'Nombre',
			'attr' => array('autofocus' => true),
			'required' => false
		))
		->add('surname', TextType::class, array(
			'label' => 'Apellidos',
			'required' => false
		))
		->add('email', TextType::class, array(
			'label' => 'Correo electrónico',
			'required' => false
		))
		->add('password', PasswordType::class, array(
			'label' => 'Contraseña',
			'required' => false
		))
		->add('submit', SubmitType::class, array(
			'label' => 'Registrarse'
		));
	}
}