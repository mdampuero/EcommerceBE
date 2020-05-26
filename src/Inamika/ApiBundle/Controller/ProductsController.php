<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com> on 2019.
//  Copyright © 2019 Inamika S.A. All rights reserved.
//

namespace Inamika\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Inamika\BackEndBundle\Entity\Product;
use Inamika\BackOfficeBundle\Form\Product\ProductType;
use Inamika\BackOfficeBundle\Form\Product\UploadType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends FOSRestController
{
    public function indexAction(Request $request)
    {
        $search = $request->query->get('search', array());
        $offset = $request->query->get('start', 0);
        $limit = $request->query->get('length', 30);
        $sort = $request->query->get('sort', null);
        $direction = $request->query->get('direction', null);
        $results=$this->getDoctrine()->getRepository(Product::class)->search($search["value"], $limit, $offset, $sort, $direction)->getQuery()->getResult();
        foreach ($results as $key => $result) {
            $results[$key]->setPriceCostoCI(round($result->getPrice()*0.79*0.9*1.21,2));
            $results[$key]->setPriceCostoSI(round($result->getPrice()*0.79*0.9,2));
            $results[$key]->setPriceListaCI(round($result->getPrice()*1.21,2));
            $results[$key]->setPriceListaSI(round($result->getPrice(),2));
        }
        return $this->handleView($this->view(array(
            'data' => $results,
            'recordsTotal' => $this->getDoctrine()->getRepository(Product::class)->total(),
            'recordsFiltered' => $this->getDoctrine()->getRepository(Product::class)->searchTotal($search["value"], $limit, $offset),
            'offset' => $offset,
            'limit' => $limit,
        )));
    }

    public function getAction($code){
        if (!$entity = $this->getDoctrine()->getRepository(Product::class)->findOneByCode($code))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));

        return $this->handleView($this->view($entity));
    }

    public function postAction(Request $request){
        $entity = new Product();
        $form = $this->createForm(ProductType::class, $entity);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    public function putAction(Request $request, $id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Product::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));
        $form = $this->createForm(ProductType::class, $entity);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    public function deleteAction(Request $request, $id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Product::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));

        $form = $this->createFormBuilder(null, array('csrf_protection' => false))->setMethod('DELETE')->getForm();
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setIsDelete(true);
            $this->getDoctrine()->getManager()->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    public function uploadAction(Request $request){
        $this->get('session')->remove('products_uploads');
        $form = $this->createForm(UploadType::class, null,array('method' => 'POST'));
        $form->submit(json_decode($request->getContent(), true));
        //$nameOriginal=explode(".", $form->get('file')->getData()->getClientOriginalName());

            // echo '<pre>';
            // print_r($_FILES["inamika_backendbundle_products_upload"]);
            // echo '<pre>';
            // exit();
            // echo '<pre>';
            // print_r($_FILES["inamika_backendbundle_products_upload"]["tmp_name"]);
            // echo '<pre>';
            // exit();

        if (($handle = fopen($_FILES["inamika_backendbundle_products_upload"]["tmp_name"]["file"], "r")) !== FALSE) {
            $i = 0;
            while (($data = fgetcsv($handle, null, ';')) !== FALSE) {
                $data = array_map("utf8_encode", $data);
                $i++;
                if ($i<=1) continue;
                $entity = new Product();
                $entity->setCode($data[0]);
                $entity->setName($data[1]);
                $entity->setPrice(str_replace(",",".",$data[2]));
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
            }
            fclose($handle);
            $em->flush();
        }
        exit();
        echo '<pre>';
        print_r($productsNew);
        echo '<pre>';
        exit();



        // exit();
        // if ($form->isSubmitted() && $form->isValid()) {
        //     dump($nameOriginal);
        //     exit();
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($entity);
        //     $em->flush();
        //     return $this->handleView($this->view($entity, Response::HTTP_OK));
        // }

        // $form = $this->createForm(UploadType::class,null,array('method' => 'POST'));
        // $form->handleRequest($request);
        // if($errors=$this->ifErrors($form)) return $errors;
        // try {
        //     $nameOriginal=explode(".", $form->get('file')->getData()->getClientOriginalName());
        //     if(end($nameOriginal)!=='csv')
        //         return $this->responseFail(array(array('property'=>'file','code'=>'744f00bc-4389-4c74-92de-9a43cde55534','message'=>$ext.$this->get('translator')->trans('FORMAT_INVALID.FILE'),'data'=>null)),200);
        //     $productsEdit=array();
        //     $productsNew=array();
        //     if (($handle = fopen($form->get('file')->getData()->getRealPath(), "r")) !== FALSE) {
        //         $i = 0;
        //         while (($data = fgetcsv($handle, null, ';')) !== FALSE) {
        //             $data = array_map("utf8_encode", $data);
        //             $i++;
        //             if ($i<=1) continue;
        //             if($exist=$this->getDoctrine()->getRepository('InamikaBackEndBundle:Products')->isExistCode($data[0]))
        //                 $productsEdit[]=$data;
        //             else
        //                 $productsNew[]=$data;
        //         }
        //         fclose($handle);
        //     }
        //     $products_upload=array('edit'=>$productsEdit,'new'=>$productsNew);
        //     $this->get('session')->set('products_uploads', $products_upload);
        //     return $this->responseOk($products_upload); 
        // }catch (Exception $exc) {
        //     return $this->responseFail(array(array('property'=>null,'code'=>$exc->getCode(),'message'=>$exc->getMessage(),'data'=>null)),200);
        // }
    }
}
