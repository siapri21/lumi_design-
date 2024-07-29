<?php

namespace App\Controller\front;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index')]
    public function index(ProductRepository $productRepository): Response
    {
        $products =  $productRepository->findAll();
        return $this->render('front/home/index.html.twig', [
            'products' => $products,
        ]);
    }
}
