<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PiecesDeRechange;
use App\Repository\PiecesDeRechangeRepository;
use App\Form\PiecesDeRechangeType;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class PiecesDeRechangeController extends AbstractController
{
    /**
     * @Route("/pieces", name="pieces")
     */
    public function index(): Response
    {
        return $this->render('pieces_de_rechange/index.html.twig', [
            'controller_name' => 'PiecesDeRechangeController',
        ]);
    }
 /**
  * @param PiecesDeRechangeRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route ("/affichepieces", name="affichepieces")
  */
     
    public function Affiche (PiecesDeRechangeRepository $repository) 
    {

    //$repo=$this->getDoctrine()->getRepository(PiecesDeRechange::class);
    $PiecesDeRechange=$repository->findAll();
    return $this->render('pieces_de_rechange/Affichepieces.html.twig',
    ['PiecesDeRechange'=>$PiecesDeRechange]);  
    }

    /**
    * @Route ("/deletepieces/{id}", name="deletepieces")
    */

    function Delete($id, PiecesDeRechangeRepository $repository){
        $PiecesDeRechange=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($PiecesDeRechange);
        $em->flush();
        return $this->redirectToRoute('affichepieces');
    }
        
    /**
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/addpieces",name="addpieces")
 */
function Add(Request $request){
    $PiecesDeRechange=new PiecesDeRechange();
    $form=$this->createForm(PiecesDeRechangeType::class,$PiecesDeRechange);
    $form->add('Add',SubmitType::class);
    $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid() ){
        $em=$this->getDoctrine()->getManager();
        $em->persist($PiecesDeRechange);
        $em->flush();
        return $this->redirectToRoute('affichepieces');
    }
    return $this->render('pieces_de_rechange/Addpieces.html.twig',[
        'form'=>$form->createView()
    ]);
    }    
    
   /**
 * @Route("/updatepieces/{id}", name="updatepieces")
 * Method({"GET", "POST"})
 */
 public function update(Request $request, $id) {
    $PiecesDeRechange = new PiecesDeRechange();
    $PiecesDeRechange = $this->getDoctrine()->getRepository(PiecesDeRechange::class)->find($id);
    
    $form = $this->createFormBuilder($PiecesDeRechange)
    ->add('nom', TextType::class)
    
    ->add('save', SubmitType::class, array(
    'label' => 'Modifier' 
    ))->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
                return $this->redirectToRoute('affichepieces');
            }
            return $this->render('pieces_de_rechange/Updatepieces.html.twig',[
             'f'=>$form->createView()]);
            }


}
