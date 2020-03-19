<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Form\RegisterType;

class UserController extends AbstractController
{

    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {	
    	//Crear el formulario
    	$user = new User();
    	$form = $this->createForm(RegisterType::class, $user);

    	//Rellenar el objeto con los datos del formulario
    	$form->handleRequest($request);

    	//Comprobando si llega el formulario
    	if ($form->isSubmitted() && $form->isValid()) {
    		//Modificar rol del objeto para guardarlo
    		$user->setRole('ROLE_USER');
    		$user->setCreatedAt(new \Datetime('now'));
    		//Cifrar contraseña
    		$encoded = $encoder->encodePassword($user, $user->getPassword());
    		$user->setPassword($encoded);

    		//Guardar usuario
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();

    		return $this->redirectToRoute('index');
    	}

        return $this->render('user/register.html.twig', [
        	'form' => $form->createView()
        ]);
    }
}
