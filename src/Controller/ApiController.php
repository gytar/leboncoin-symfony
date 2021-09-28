<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/')]

class ApiController extends AbstractController
{

    #[Route('', name:'index_api')]
    public function index(UserRepository $userRepository) {
        $users = $userRepository->findAll();

        return $this->render('api/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('products-sales', name: 'list_products_api')]
    public function listProductsOnSale(Request $request, ProductRepository $productRepository, PaginatorInterface $paginator) {
        $data = $productRepository->findOnSale();

        $productsOnSale = $paginator->paginate(
            $data, 
            $request->query->getInt('page', 1), 
            20
        );

        return $this->render('api/list.html.twig', [
            'products' => $productsOnSale,    
        ]);
    }


    #[Route('products-sales-json', name: 'list_products_api_json')]
    public function listProductsOnSaleJson(ProductRepository $productRepository, SerializerInterface $serializer) {
        $data = $productRepository->findOnSale();

        $productsOnSale = $serializer->serialize($data, 'json', [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object) {
                return $object->getId();
            },
        ]);

        return new JsonResponse($productsOnSale, 200, [], true);
    }




    #[Route("user/{id}", name:"list_products_user_api")]
    public function listProductsByUser(Request $request, User $user, PaginatorInterface $paginator, ProductRepository $productRepository) {
        $data = $productRepository->findOnSaleByUser($user);

        $userProducts = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('api/user_product.html.twig', [
            'user' => $user,
            'products' => $userProducts,
        ]);  
    }

    #[Route("user-json/{id}", name:"list_products_user_api_json")]
    public function listProductsByUserJson(User $user, SerializerInterface $serializer, ProductRepository $productRepository) {
        $data = $productRepository->findOnSaleByUser($user);

        $userProducts = $serializer->serialize($data, 'json', [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function($object) {
                return $object->getId();
            },
        ]);

        return new JsonResponse($userProducts, 200, [], true);
    }
}
