<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/*

    Gros soucis avec cette partie de l'application, les deux formulaires ensemble ne veulent pas fonctionner,
    j'ai tenté de passer par les fragments mais sans grand succès
    il y a sûrment un problème avec la route, mais je n'arrive pas à trouver
    je vais me focaliser sur la suite de l'exercice... 

*/
class WelcomeActionController extends AbstractController
{
    #[Route('/', name: 'welcome_action')]
    public function index(): Response
    {
        return $this->render('welcome_action/index.html.twig');
    }
}
