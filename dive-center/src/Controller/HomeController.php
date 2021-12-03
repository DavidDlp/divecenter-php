<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

    /**
     * @Route("/home", methods={"GET"}, name="homePage") 
     */
    public function homepage (){
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render("home/home.html.twig");
    }
}