<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\BonDeCommande;
use App\Repository\BonDeCommandeRepository;
use App\Form\BonDeCommandeType;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class BonDeCommandeController extends AbstractController
{
    /**
     * @Route("/bondecommande", name="bondecommande")
     */
    public function index(): Response
    {
        return $this->render('bon_de_commande/index.html.twig', [
            'controller_name' => 'BonDeCommandeController',
        ]);
    }
 /**
  * @param BonDeCommandeRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route ("/affichebondecmd", name="affichebondecmd")
  */
     
    public function Affiche (BonDeCommandeRepository $repository) 
    {

    //$repo=$this->getDoctrine()->getRepository(BonDeCommande::class);
    $BonDeCommande=$repository->findAll();
    return $this->render('bon_de_commande/Affichebondecmd.html.twig',
    ['BonDeCommande'=>$BonDeCommande]);  
    }

    /**
    * @Route ("/deletebondecmd/{id}", name="deletebondecmd")
    */

    function Delete($id, BonDeCommandeRepository $repository){
        $BonDeCommande=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($BonDeCommande);
        $em->flush();
        return $this->redirectToRoute('affichebondecmd');
    }
        
    /**
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/addbondecmd",name="addbondecmd")
 */
function Add(Request $request){
    $BonDeCommande=new BonDeCommande();
    $form=$this->createForm(BonDeCommandeType::class,$BonDeCommande);
    $form->add('Add',SubmitType::class);
    $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid() ){
        $em=$this->getDoctrine()->getManager();
        $em->persist($BonDeCommande);
        $em->flush();
        return $this->redirectToRoute('affichebondecmd');
    }
    return $this->render('bon_de_commande/Addbondecmd.html.twig',[
        'form'=>$form->createView()
    ]);
    }    
    
     /**
 * @Route("/updatebondecmd/{id}", name="updatebondecmd")
 * Method({"GET", "POST"})
 */
 public function update(Request $request, $id) {
    $BonDeCommande = new BonDeCommande();
    $BonDeCommande = $this->getDoctrine()->getRepository(BonDeCommande::class)->find($id);
    
    $form = $this->createFormBuilder($BonDeCommande)
    ->add('numbc', TextType::class)
    ->add('nmbrmat', TextType::class)
    ->add('prix', TextType::class)
    ->add('save', SubmitType::class, array(
    'label' => 'Modifier' 
    ))->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
    
    return $this->redirectToRoute('affichebondecmd');
    }

            return $this->render('bon_de_commande/Updatebondecmd.html.twig',[
             'f'=>$form->createView()]);
            
            
            }

}