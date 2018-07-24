<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Article;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\LoginType;
use App\Form\ArticleType;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;

use Symfony\Component\HttpFoundation\Request;


class PrintController extends Controller
{
    /**
     * @Route("/print", name="print")
     */
    public function index()
    {

    	$user = new User();
    	$user->setFirstname("Paladin");
    	$user->setBirthday(new \Datetime());

    	$user2 = new User();
    	$user2->setFirstname("Magicien");
    	$user2->setBirthday(new \Datetime());

    	$tabs = array($user, $user2);

    	$em = $this->getDoctrine()->getManager();

    	$users = $em->getRepository(User::class)->findAll();

        return $this->render('print/index.html.twig', [
            'controller_name' => 'PrintController',
            'tabs' => $tabs,
            'users' => $users
        ]);
    }

    /**
     * @Route("/form", name="form")
     */
    public function form(Request $request, UserRepository $userRepository)
    {
    	$user = new User();
    	$form = $this->createForm(LoginType::class, $user);
    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($user);
    		$em->flush();
    	}

    	$users = $userRepository->findAll();

    	return $this->render('user/index.html.twig', array(
    		'form' => $form->createView(),
    		'users'=> $users,
    	));
    }

    /**
     * @Route("/article", name="article")
     */
    public function article(Request $request, ArticleRepository $articleRepository)
    {
    	$article = new Article();
    	$form = $this->createForm(ArticleType::class, $article);
    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($article);
    		$em->flush();
    	}

    	$articles = $articleRepository->findAll();

    	return $this->render('article/index.html.twig', array(
    		'form' => $form->createView(),
    		'articles'=> $articles,
    	));
    }

}
