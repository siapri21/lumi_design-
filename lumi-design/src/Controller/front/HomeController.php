<?php

namespace App\Controller\front;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index')]
    public function index(Request $request, ProductRepository $productRepository, PaginatorInterface $paginator): Response
    {
        $query = $productRepository->createQueryBuilder('p')
            ->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1), // Numéro de page, 1 par défaut
            9 // Nombre de produits par page
        );

        return $this->render('front/home/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/product/{slug}', name: 'product_details', methods:['GET'])]
      
    public function productDetails(Product $product): Response
    {
        return $this->render('front/home/product_details.html.twig', [
            'product' => $product,
        ]);
    }

}