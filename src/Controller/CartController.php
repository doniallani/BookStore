<?php

namespace App\Controller;
//this file defines the create, delete , edit functions of the cart aka shopping Cart
use App\Entity\Cart;
use App\Entity\Orde;
use App\Entity\Admin;
use App\Entity\Book;
use App\Entity\Img;
use App\Form\CartType;
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cart")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="cart_index", methods={"GET"})
     */
    public function index(CartRepository $cartRepository): Response
    {
        return $this->render('cart/index.html.twig', [
            'carts' => $cartRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cart_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cart = new Cart();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cart);
            $entityManager->flush();

            return $this->redirectToRoute('cart_index');
        }

        return $this->render('cart/new.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_show", methods={"GET"})
     */
    public function show(Cart $cart): Response
    {
        return $this->render('cart/show.html.twig', [
            'cart' => $cart,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cart_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cart $cart): Response
    {
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cart_index');
        }

        return $this->render('cart/edit.html.twig', [
            'cart' => $cart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cart_delete", methods={"DELETE","GET","POST"})
     */
    public function delete(Request $request, Cart $cart)
    {  $user= $this->getDoctrine()->getRepository(Admin::class)->findBy(['id' =>$cart->getUser()]);
        $orders = $this->getDoctrine()->getRepository(Orde::class)->findBy(['cart'=>$cart->getId()]);
        $u=$cart->getUser();
        foreach ($user as $key) {
            $key->setCart($key->getCart() -1);
            
        }
        if ($this->isCsrfTokenValid('delete'.$cart->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cart);
            $entityManager->flush();
            foreach ($orders as $order) {
            $entityManager->remove($order);
            $entityManager->flush();
            }
        }

        return  $this->redirectToRoute('dashboard');
    }

     /**
     * @Route("/user/{id}", name="user_cart", methods={"GET"})
     */
    public function userCart($id): Response
    {$img = $this->getDoctrine()->getRepository(Img::class)->findAll();
        $cart= $this->getDoctrine()->getRepository(Cart::class)->findBy(['user' =>$id]);
        $books=[];
        $i=0;
        foreach($cart as $car) {
            $book= $this->getDoctrine()->getRepository(Book::class)->findBy(['id' =>$car->getBook()]);
            $books [$i] = $book;
            $i++;

        }


        return $this->render('cart/show.html.twig', [
            'carts' => $cart, 'books' => $books, 'imgs' => $img
        ]);
    }


}
