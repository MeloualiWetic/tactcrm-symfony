<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ClientViewController extends AbstractController
{
    /**
     * @Route("/client/view", name="client_view")
     */
    public function index(UserInterface $user,FactureRepository $factureRepository): Response
    {
        $factures = $factureRepository->findFacturesByUtilisateur($user);
        return $this->render('client_view/index.html.twig', [
            'controller_name' => 'ClientViewController',
            'factures'=>$factures
        ]);
    }

    /**
     * @Route("/client/view/{id}", name="client_facture_show", methods={"GET"})
     */
    public function show(Facture $facture): Response
    {
        return $this->render('facture/show.html.twig', [
            'facture' => $facture,
        ]);
    }
}
