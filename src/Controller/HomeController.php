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


class HomeController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request, UserRepository $userRepository)
    {

    	$em = $this->getDoctrine()->getManager();

    	$users = $em->getRepository(User::class)->findAll();
        // $articles = $em->getRepository(Article::class)->findAll();

        return $this->render('home/index.html.twig', [
            'users' => $users
        ]);
    }
}
