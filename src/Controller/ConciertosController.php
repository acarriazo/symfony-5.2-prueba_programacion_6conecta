<?php

namespace App\Controller;

use App\Service\ConciertosService;
use App\Service\MailerService;

use App\Entity\Conciertos;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/conciertos")
 */
class ConciertosController extends AbstractController
{
    
   
    /**
     * @Route("/{id}/calculate", name="conciertos_calculate", methods={"GET"})
     */
    
    
    public function calculate(Conciertos $concierto, ConciertosService $conciertoService, MailerService $mailerService): Response
    {
            
        $conciertoRentabilidad = $conciertoService->calculaRentabilidad($concierto);
        
        
        $mailerService->sendEmail($conciertoRentabilidad);
                                                
        return new Response(
            '<html><body>Se ha calculado la rentabilidad y enviado un email.</body></html>'
        );
    }    

    
}
