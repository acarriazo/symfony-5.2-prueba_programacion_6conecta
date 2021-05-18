<?php

namespace App\Service;

use App\Entity\Conciertos;
use App\Repository\ConciertosRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class MailerService extends AbstractController


{

    private $conciertosRepository;
    private $mailer;

    public function __construct(ConciertosRepository $conciertosRepository, MailerInterface $mailer)
    {
        $this->conciertosRepository = $conciertosRepository;
        $this->mailer = $mailer;
    }    
    
    
    

    public function sendEmail(Conciertos $conciertoRentabilidad)

    {
            

            $rentabilidad = $this->conciertosRepository->findOneBy(['id' => $conciertoRentabilidad])->getRentabilidad();
            $asunto = $this->conciertosRepository->findOneBy(['id' => $conciertoRentabilidad])->getNombre();
            
            $message = (new Email())
                ->from('concert.manager@conciertos.com')
                ->to('antonio.carriazo@gmail.com')
                ->subject('Rentabilidad Concierto ' . $asunto)
                ->text('Sender : concert.manager@conciertos.com'.\PHP_EOL.
                    'Le adjuntamos los datos de su último concierto: ' . $rentabilidad . ' €');
          
                
   
            
            $this->mailer->send($message);

                
        }



      
    
}