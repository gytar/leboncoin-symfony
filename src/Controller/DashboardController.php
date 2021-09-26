<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findByUser($this->getUser());
        return $this->render('dashboard/index.html.twig', [
            'products' => $products,
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/on_sale?id={id}', name: 'on_sale')]
    public function onSale(Product $product) {
        $product->setIsOnSale(!$product->getisOnSale());
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('dashboard', [], Response::HTTP_SEE_OTHER);
    }
}
