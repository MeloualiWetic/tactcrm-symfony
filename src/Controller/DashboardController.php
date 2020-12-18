<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\FactureRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/dashboard")
 *
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard" ,methods={"GET"})
     */
    public function index( UserInterface $user, ArticleRepository $articleRepository,UtilisateurRepository $utilisateurRepository, FactureRepository $factureRepository): Response
    {
        $roles = $user->getRoles();
        if ($roles[0] != "ROLE_ADMIN"){
            return $this->redirectToRoute('client_view');
        }else{

            //        DONUT CHART
        $facturePaye = $factureRepository->countFacturePaye();
        $factureNoPaye = $factureRepository->countFactureNoPaye();
        $outputDonutChart [] = (int)$facturePaye;
        $outputDonutChart [] = (int)$factureNoPaye;
        $outputDonutChart = new Response(json_encode($outputDonutChart));
//        <--->
        $articleCount = $articleRepository->countArticle();
        $factureCount =  $factureRepository->countFacture();
        $countClient = $utilisateurRepository->countUtilisateurs();
        $factureByMonth []  = $factureRepository->countFactureByMonth();
        $output = [];
        $k = 1;
        for ( $j=0;$j< count($factureByMonth);$j++){
            for ( $i=0;$i<12;$i++){
                if (is_null($factureByMonth[$j]) ){
                    $output[$i] = [0,0,0,0,0,0,0,0,0,0,0,0];

                }else{
                    if($factureByMonth[$j]['byMonth']== $k){
                        $output[$i] = (int)$factureByMonth[$j]['count'];
                    }else{
                        $output[$i] = 0;
                    }
                    $k++;
                }
            }
        }
        $output = new Response(json_encode($output));
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'countArticle'=>$articleCount,
            'countFacture'=>$factureCount,
            'countClient' => $countClient,
            'output'=> $output,
            'outputDonutChart' => $outputDonutChart,

        ]);

        }
    }

}
