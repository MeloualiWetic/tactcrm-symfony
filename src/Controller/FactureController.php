<?php

namespace App\Controller;

use App\Entity\DetailFacture;
use App\Entity\Facture;
use App\Form\FactureType;
use App\Repository\ArticleRepository;
use App\Repository\DetailFactureRepository;
use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/facture")
 */
class FactureController extends AbstractController
{
    /**
     * @Route("/", name="facture_index", methods={"GET"})
     */
    public function index(FactureRepository $factureRepository): Response
    {
        return $this->render('facture/index.html.twig', [
            'factures' => $factureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="facture_new", methods={"GET","POST"})
     */
    public function new(Request $request,ArticleRepository $articleRepository): Response
    {
        $listarticles = $articleRepository->findAll();
        $facture = new Facture();
        $numero = "FAC".date("ymdHis");
        $facture->setNumero($numero);
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facture);
            $entityManager->flush();

            return $this->redirectToRoute('facture_index');
        }

        return $this->render('facture/new.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
            'listarticles'=>$listarticles,
        ]);
    }

    /**
     * @Route("/{id}", name="facture_show", methods={"GET"})
     */
    public function show(Facture $facture): Response
    {

        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="facture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Facture $facture,ArticleRepository $articleRepository): Response
    {
        $listarticles = $articleRepository->findAll();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);
        $detailFacture = $facture->getDetailFactures();
        $HT = 0;
        foreach ($detailFacture as $value){
            $HT += $value->getPrixVente() * $value->getQte();

        }
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('facture_index');
        }

        return $this->render('facture/edit.html.twig', [
            'facture' => $facture,
            'form' => $form->createView(),
            'listarticles'=>$listarticles,
            'HT'=>$HT
        ]);
    }

    /**
     * @Route("/{id}", name="facture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Facture $facture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($facture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('facture_index');
    }
}
