<?php

namespace App\Controller;

use App\Entity\Orde;
use App\Entity\Img;
use App\Entity\Book;
use App\Entity\Admin;
use App\Form\OrdeType;
use App\Repository\OrdeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/orde")
 */
class OrdeController extends AbstractController
{
    /**
     * @Route("/", name="orde_index", methods={"GET"})
     */
    public function index(OrdeRepository $ordeRepository): Response
    {
        return $this->render('orde/index.html.twig', [
            'ordes' => $ordeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="orde_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $orde = new Orde();
        $form = $this->createForm(OrdeType::class, $orde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($orde);
            $entityManager->flush();

            return $this->redirectToRoute('orde_index');
        }

        return $this->render('orde/new.html.twig', [
            'orde' => $orde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="orde_show", methods={"GET"})
     */
    public function show(Orde $orde): Response
    {
        return $this->render('orde/show.html.twig', [
            'orde' => $orde,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="orde_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Orde $orde): Response
    {
        $form = $this->createForm(OrdeType::class, $orde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orde_index');
        }

        return $this->render('orde/edit.html.twig', [
            'orde' => $orde,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="orde_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Orde $orde): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orde->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orde);
            $entityManager->flush();
        }

        return $this->redirectToRoute('orde_index');
    }

    
     /**
     * @Route("/user/{id}", name="user_orde", methods={"GET"})
     */
    public function userOrder($id): Response
    {$img = $this->getDoctrine()->getRepository(Img::class)->findAll();
        $order= $this->getDoctrine()->getRepository(Orde::class)->findBy(['user' =>$id]);
        $books=[];
        $i=0;
        foreach($order as $car) {
            $book= $this->getDoctrine()->getRepository(Book::class)->findBy(['id' =>$car->getBook()]);
            $books [$i] = $book;
            $i++;

        }


        return $this->render('orde/show.html.twig', [
            'carts' => $order, 'books' => $books, 'imgs' => $img
        ]);
    }

}
