<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{ 
    #[Route('/')]
    public function index(): Response
    {   
        return $this->render('home/index.html.twig');
    }
}

/*
$contents = $this->renderView('home/index.html.twig', [
  'title' => 'Home',
  'message' => 'Hello from a home controller'
]);

return new Response($contents);
*/