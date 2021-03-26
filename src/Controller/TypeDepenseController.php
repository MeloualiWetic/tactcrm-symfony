<?php

namespace App\Controller;

use App\Entity\TypeDepense;
use App\Form\TypeDepenseType;
use App\Repository\TypeDepenseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/depense")
 */
class TypeDepenseController extends AbstractController
{
    /**
     * @Route("/", name="type_depense_index", methods={"GET"})
     */
    public function index(TypeDepenseRepository $typeDepenseRepository): Response
    {
        return $this->render('type_depense/index.html.twig', [
            'type_depenses' => $typeDepenseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_depense_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeDepense = new TypeDepense();
        $form = $this->createForm(TypeDepenseType::class, $typeDepense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeDepense);
            $entityManager->flush();

            return $this->redirectToRoute('type_depense_index');
        }

        return $this->render('type_depense/new.html.twig', [
            'type_depense' => $typeDepense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_depense_show", methods={"GET"})
     */
    public function show(TypeDepense $typeDepense): Response
    {
        return $this->render('type_depense/show.html.twig', [
            'type_depense' => $typeDepense,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_depense_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeDepense $typeDepense): Response
    {
        $form = $this->createForm(TypeDepenseType::class, $typeDepense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_depense_index');
        }

        return $this->render('type_depense/edit.html.twig', [
            'type_depense' => $typeDepense,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_depense_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeDepense $typeDepense): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDepense->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeDepense);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_depense_index');
    }
}
