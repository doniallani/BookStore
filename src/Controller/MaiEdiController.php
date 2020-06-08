<?php

namespace App\Controller;
//this file defines the create, delete , edit functions of Editing house
use App\Entity\MaiEdi;
use App\Form\MaiEdiType;
use App\Repository\MaiEdiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mai/edi")
 */
class MaiEdiController extends AbstractController
{
    /**
     * @Route("/", name="mai_edi_index", methods={"GET"})
     */
    public function index(MaiEdiRepository $maiEdiRepository): Response
    {
        return $this->render('mai_edi/index.html.twig', [
            'mai_edis' => $maiEdiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mai_edi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $maiEdi = new MaiEdi();
        $form = $this->createForm(MaiEdiType::class, $maiEdi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($maiEdi);
            $entityManager->flush();

            return $this->redirectToRoute('mai_edi_index');
        }

        return $this->render('mai_edi/new.html.twig', [
            'mai_edi' => $maiEdi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mai_edi_show", methods={"GET"})
     */
    public function show(MaiEdi $maiEdi): Response
    {
        return $this->render('mai_edi/show.html.twig', [
            'mai_edi' => $maiEdi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mai_edi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MaiEdi $maiEdi): Response
    {
        $form = $this->createForm(MaiEdiType::class, $maiEdi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mai_edi_index');
        }

        return $this->render('mai_edi/edit.html.twig', [
            'mai_edi' => $maiEdi,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mai_edi_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MaiEdi $maiEdi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maiEdi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maiEdi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mai_edi_index');
    }
}
