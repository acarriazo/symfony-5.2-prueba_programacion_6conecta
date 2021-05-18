<?php

namespace App\Service;

use App\Entity\Conciertos;

use App\Repository\GruposConciertosRepository;
use App\Repository\GruposMediosRepository;
use App\Repository\ConciertosRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class ConciertosService extends AbstractController
{

    
    private $concierto;
    private $gruposConciertosRepository;
    private $gruposMediosRepository;
    private $conciertosRepository;

    public function __construct(
            GruposConciertosRepository $gruposConciertosRepository, 
            GruposMediosRepository $gruposMediosRepository,
            ConciertosRepository $conciertosRepository
            )
    {
        $this->gruposConciertosRepository = $gruposConciertosRepository;
        $this->gruposMediosRepository = $gruposMediosRepository;
        $this->conciertosRepository = $conciertosRepository;
    }
    
    
    
    public function calculaRentabilidad(Conciertos $concierto): Conciertos
    {
            
        $this->concierto = $concierto;
        
        $gruposConcierto = $this->gruposConciertosRepository->findBy(['id_concierto' => $this->concierto]);                  
        dump($gruposConcierto);  
        
        $ingresosConcierto=0;
        $costesConcierto=0;
        $rentabilidadConcierto=0;
        
                 
        //calculo los ingresos 
        $precioEntrada = $this->conciertosRepository->findOneBy(['id' => $this->concierto])->getIdRecinto()->getPrecioEntrada();  
        $numeroEspectadores =  $this->conciertosRepository->findOneBy(['id' => $this->concierto])->getNumeroEspectadores();
        $ingresosConcierto = $precioEntrada * $numeroEspectadores;
        dump($ingresosConcierto);          
                
        //calculo los costes
        foreach ($gruposConcierto as $grupo) {                   
           $costesConcierto+=($grupo->getIdGrupo()->getCache());         
       }
        $costesConcierto+=$this->conciertosRepository->findOneBy(['id' => $this->concierto])->getIdRecinto()->getCosteAlquiler();  
        $costesConcierto+=$ingresosConcierto * 0.1;
       
        dump($costesConcierto);
      
        //calculo la rentabilidad
        $rentabilidadConcierto = $ingresosConcierto - $costesConcierto;
        
        dump($rentabilidadConcierto);
        
        //persisto la rentabilidad
        $this->conciertosRepository->findOneBy(['id' => $this->concierto])->setRentabilidad($rentabilidadConcierto);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($this->concierto);
        $entityManager->flush();
        
        $mediosConcierto = $this->gruposMediosRepository->findBy(['id_concierto' => $this->concierto]);                  
        dump($mediosConcierto);   
        
     
        foreach ($mediosConcierto as $medio) {                   
           dump($medio->getIdMedio()->getNombre());         
       }         
         
       
        $promotorConcierto = $this->conciertosRepository->findOneBy(['id' => $this->concierto])->getIdPromotor()->getNombre();                  
        dump($promotorConcierto); 
        
        
        $recintoConcierto = $this->conciertosRepository->findOneBy(['id' => $this->concierto])->getIdRecinto()->getNombre();                  
        dump($recintoConcierto);      
      
         
        
        
        return $this->concierto;
        
    }
   
    


}
