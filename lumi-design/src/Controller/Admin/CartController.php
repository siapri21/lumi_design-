<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/cart', name: 'admin_cart_')]
class CartController  extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index() 
    {
        return $this->render('admin/cart/index.html.twig');
    }
}