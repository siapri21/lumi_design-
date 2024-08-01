<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/cart', name: 'admin_cart_')]
class CartController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        return $this->render('admin/cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        if (!isset($cart[$id])) {
            $cart[$id] = 0;
        }

        $cart[$id]++;

        $session->set('cart', $cart);

        return $this->redirectToRoute('admin_cart_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            } else {
                unset($cart[$id]);
            }
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('admin_cart_index');
    }

    #[Route('/clear', name: 'clear')]
    public function clear(SessionInterface $session): Response
    {
        $session->remove('cart');

        return $this->redirectToRoute('admin_cart_index');
    }
}