<?php

namespace App\Controller;

use App\Entity\DetailFacture;
use App\Form\DetailFactureType;
use App\Repository\DetailFactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/detailfacture")
 */
class DetailFactureController extends AbstractController
{
    /**
     * @Route("/", name="detail_facture_index", methods={"GET"})
     */
    public function index(DetailFactureRepository $detailFactureRepository): Response
    {
        return $this->render('detail_facture/index.html.twig', [
            'detail_factures' => $detailFactureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="detail_facture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $detailFacture = new DetailFacture();
        $form = $this->createForm(DetailFactureType::class, $detailFacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($detailFacture);
            $entityManager->flush();

            return $this->redirectToRoute('detail_facture_index');
        }

        return $this->render('detail_facture/new.html.twig', [
            'detail_facture' => $detailFacture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="detail_facture_show", methods={"GET"})
     */
    public function show(DetailFacture $detailFacture): Response
    {
        return $this->render('detail_facture/show.html.twig', [
            'detail_facture' => $detailFacture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="detail_facture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DetailFacture $detailFacture): Response
    {
        $form = $this->createForm(DetailFactureType::class, $detailFacture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('detail_facture_index');
        }

        return $this->render('detail_facture/edit.html.twig', [
            'detail_facture' => $detailFacture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("detailfacture/{id}", name="detail_facture_delete", methods={"GET", "DELETE"})
     */
    public function delete(Request $request, DetailFacture $detailFacture): Response
    {
            $idFacture = $detailFacture->getFacture()->getId();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($detailFacture);
            $entityManager->flush();


        return $this->redirectToRoute('facture_edit',array('id' => $idFacture));
    }
}
