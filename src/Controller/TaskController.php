<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use App\Form\TaskType;
use App\Entity\User;
use \Symfony\Component\Security\Core\User\UserInterface;

class TaskController extends AbstractController
{
    public function index()
    {
    	//Prueba de entidades
    	$em = $this->getDoctrine()->getManager();
        $task_repo = $this->getDoctrine()->getRepository(Task::class);
        $tasks = $task_repo->findBy([], ['id' => 'DESC']);

        /*
    	foreach ($tasks as $task) {
    		echo $task->getUser()->getEmail().': '.$task->getTitle()."<br>";
    	}
    	

    	$user_repo = $this->getDoctrine()->getRepository(User::class);
    	$users = $user_repo->findAll();

    	foreach ($users as $user) {
    		echo '<h1>'.$user->getName().' '.$user->getSurname().'</h1>'."<br>";

    		foreach ($user->getTasks() as $task) {
    		echo '<h3>'.$task->getTitle().'</h3>'."<br>";
    	}
    	}
        */

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    public function detail(Task $task) {
        if(!$task) {
            return $this->redirectToRout('tasks');
        } else {
            return $this->render('task/detail.html.twig', [
                'task' => $task
            ]);
        }

    }

    public function creation(Request $request, UserInterface $user) {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())  {
            $task->setCreatedAt(new \Datetime('now'));
            $task->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect($this->generateUrl('detail', ['id' => $task->getId()]));
        }

        return $this->render('task/creation.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function myTasks(UserInterface $user) {
        $tasks = $user->getTasks();

        return $this->render('task/my-tasks.html.twig', [
            'tasks' => $tasks
        ]);
    }

    public function edit(Request $request, UserInterface $user, Task $task) {
        if (!$user || $user->getId() != $task->getUser()->getId()) {
            return $this->redirectToRout('tasks');
        }
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())  {
            //$task->setCreatedAt(new \Datetime('now'));
            //$task->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect($this->generateUrl('detail', ['id' => $task->getId()]));
        }

        return $this->render('task/creation.html.twig', [
            'edit' => true,
            'task'  => $task,
            'form' => $form->createView()
        ]);
    }

    public function delete(UserInterface $user, Task $task) {
        if (!$user || !$task || $user->getId() != $task->getUser()->getId()) {
            return $this->redirectToRout('tasks');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return $this->redirectToRout('tasks');
    }
}
