<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Repository\DetailFactureRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/makepdf")
 */
class MakePdfController extends AbstractController
{
    /**
     * @Route("/{id}/pdf", name="facture_pdf", methods={"GET"})
     */
    public function index(Facture $facture, DetailFactureRepository $detailFactureRepository)
    {
         // Configure Dompdf according to your needs
         $pdfOptions = new Options();
         $pdfOptions->set('defaultFont', 'Arial');
         $pdfOptions->setIsRemoteEnabled(true);
        //  $pdfOptions->setTempDir('temp');
         $facture;
         $detailsfacture = $detailFactureRepository->findByDetailFactureId($facture);
//         $detailsArray  = array_chunk($detailsfacture,1);

         // Instantiate Dompdf with our options
         $dompdf = new Dompdf($pdfOptions);

//         Retrieve the HTML generated in our twig file
        $html = $this->renderView('make_pdf/index.html.twig', [
            'facture' => $facture,
            'detailsfacture'=>$detailsfacture,
        ]);

         // Load HTML to Dompdf
         $dompdf->loadHtml($html);

         // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
         $dompdf->setPaper('A4', 'portrait');

         // Render the HTML as PDF
         $dompdf->render();

         // Output the generated PDF to Browser (inline view)
         $dompdf->stream("mypdf.pdf", [
             "Attachment" => false
         ]);
         exit(0);
    }
}
