<?php

namespace App\Controller;

use App\Service\ConciertosService;
use App\Service\MailerService;

use App\Entity\Conciertos;
use App\Form\ConciertosType;
use App\Repository\GruposConciertosRepository;
use App\Repository\GruposMediosRepository;
use App\Repository\ConciertosRepository;

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
     * @Route("/", name="conciertos_index", methods={"GET"})
     */
    public function index(ConciertosRepository $conciertosRepository): Response
    {
        return $this->render('conciertos/index.html.twig', [
            'conciertos' => $conciertosRepository->findAll(),
        ]);
    }
    


    
    
    
    /**
     * @Route("/{id}/calculate", name="conciertos_calculate", methods={"GET"})
     */
    
    
    public function calculate(
            Conciertos $concierto, 
            GruposConciertosRepository $gruposConciertosRepository, 
            GruposMediosRepository $gruposMediosRepository,
            ConciertosRepository $conciertosRepository
            ): Response
    {
            
    
        
        $gruposConcierto = $gruposConciertosRepository->findBy(['id_concierto' => $concierto]);                  
        dump($gruposConcierto);  
        
        $ingresosConcierto=0;
        $costesConcierto=0;
        $rentabilidadConcierto=0;
        
                 
        //calculo los ingresos 
        $precioEntrada = $conciertosRepository->findOneBy(['id' => $concierto])->getIdRecinto()->getPrecioEntrada();  
        $numeroEspectadores =  $conciertosRepository->findOneBy(['id' => $concierto])->getNumeroEspectadores();
        $ingresosConcierto = $precioEntrada * $numeroEspectadores;
        dump($ingresosConcierto);          
                
        //calculo los costes
        foreach ($gruposConcierto as $grupo) {                   
           $costesConcierto+=($grupo->getIdGrupo()->getCache());         
       }
        $costesConcierto+=$conciertosRepository->findOneBy(['id' => $concierto])->getIdRecinto()->getCosteAlquiler();  
        $costesConcierto+=$ingresosConcierto * 0.1;
       
        dump($costesConcierto);
      
        //calculo la rentabilidad
        $rentabilidadConcierto = $ingresosConcierto - $costesConcierto;
        
        dump($rentabilidadConcierto);
        
        //persisto la rentabilidad
        $conciertosRepository->findOneBy(['id' => $concierto])->setRentabilidad($rentabilidadConcierto);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($concierto);
        $entityManager->flush();
        
        $mediosConcierto = $gruposMediosRepository->findBy(['id_concierto' => $concierto]);                  
        dump($mediosConcierto);   
        
     
        foreach ($mediosConcierto as $medio) {                   
           dump($medio->getIdMedio()->getNombre());         
       }         
         
       
        $promotorConcierto = $conciertosRepository->findOneBy(['id' => $concierto])->getIdPromotor()->getNombre();                  
        dump($promotorConcierto); 
        
        
        $recintoConcierto = $conciertosRepository->findOneBy(['id' => $concierto])->getIdRecinto()->getNombre();                  
        dump($recintoConcierto);      
      
         
        
        
        return $this->render('conciertos/show.html.twig', [
            'concierto' => $concierto,
        ]);
    }
   
    /**
     * @Route("/{id}/calculatenew", name="conciertos_calculatenew", methods={"GET"})
     */
    
    
    public function calculateNew(Conciertos $concierto, ConciertosService $conciertoService, MailerService $mailerService): Response
    {
            
        $conciertoRentabilidad = $conciertoService->calculaRentabilidad($concierto);
        
        
        $mailerService->sendEmail($conciertoRentabilidad);
                                                
        return $this->render('conciertos/show.html.twig', [
            'concierto' => $conciertoRentabilidad,
        ]);
    }    

    /**
     * @Route("/new", name="conciertos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $concierto = new Conciertos();
        $form = $this->createForm(ConciertosType::class, $concierto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concierto);
            $entityManager->flush();

            return $this->redirectToRoute('conciertos_index');
        }

        return $this->render('conciertos/new.html.twig', [
            'concierto' => $concierto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conciertos_show", methods={"GET"})
     */
    public function show(Conciertos $concierto): Response
    {
        return $this->render('conciertos/show.html.twig', [
            'concierto' => $concierto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="conciertos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Conciertos $concierto): Response
    {
        $form = $this->createForm(ConciertosType::class, $concierto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conciertos_index');
        }

        return $this->render('conciertos/edit.html.twig', [
            'concierto' => $concierto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="conciertos_delete", methods={"POST"})
     */
    public function delete(Request $request, Conciertos $concierto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$concierto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($concierto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conciertos_index');
    }
}
