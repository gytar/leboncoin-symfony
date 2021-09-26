<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrowseController extends AbstractController
{
    #[Route('/browse', name: 'browse')]
    public function index(ProductRepository $productRepository): Response
    {
        $listProduct = $productRepository->findOnSale();
        return $this->render('browse/index.html.twig', [
            'products' => $listProduct,
        ]);
    }
}
