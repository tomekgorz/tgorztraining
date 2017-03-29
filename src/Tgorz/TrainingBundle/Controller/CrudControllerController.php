<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Tgorz\TrainingBundle\Entity\Product;
use Tgorz\TrainingBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;

class CrudControllerController extends Controller
{
    /**
     * @Route("/", name="tgorz_training_list")
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()->getRepository(\Tgorz\TrainingBundle\Entity\Product::class);
        $products = $repository->findAll();
        
        return $this->render('TgorzTrainingBundle:CrudController:list.html.twig', array(
           'products' => $products,
        ));
    }

    /**
     * @Route("/update/{id}", name="tgorz_training_update")
     */
    public function updateAction(\Symfony\Component\HttpFoundation\Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository(\Tgorz\TrainingBundle\Entity\Product::class);
        $product = $repository->find($id);
        
        if($product == NULL){
            $message = "Nie znaleziono takiego produktu";
            throw $this->createNotFoundException($message);
        }
        $form = $this->createForm(\Tgorz\TrainingBundle\Form\ProductType::class, $product);
        if($request->isMethod("POST")){
            $form->handleRequest($request);
            
            if($form->isSubmitted() && $form->isValid()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($product);
                $entityManager->flush();
                
                return $this->redirectToRoute('tgorz_training_list');
            }
        }
        return $this->render('TgorzTrainingBundle:CrudController:update.html.twig', array(
            'form' => isset($form) ? $form->createView() : NULL,
            'product' => $product,
            ));
    }

    /**
     * @Route("/add", name="tgorz_training_add")
     */
    public function addAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        
        if($request->isMethod("POST")){
            if($form->isSubmitted() && $form->isValid()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($product);
                $entityManager->flush();
                return $this->redirectToRoute('tgorz_training_list');
            }
        }
        
        return $this->render('TgorzTrainingBundle:CrudController:add.html.twig', array(
            'form' => isset($form) ? $form->createView() : NULL,
        ));
    }

    /**
     * @Route("/delete", name="tgorz_training_delete")
     */
    public function deleteAction()
    {
        return $this->render('TgorzTrainingBundle:CrudController:delete.html.twig', array(
            // ...
        ));
    }

}
