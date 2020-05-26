<?php

//
//  Created by Mauricio Ampuero <mdampuero@gmail.com> on 2019.
//  Copyright © 2019 Inamika S.A. All rights reserved.
//

namespace Inamika\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Inamika\BackEndBundle\Entity\Orders;
use Inamika\BackEndBundle\Entity\OrdersItem;
use Inamika\BackEndBundle\Entity\Product;
use Inamika\BackOfficeBundle\Form\Order\OrderType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends FOSRestController
{
    public function indexAction(Request $request)
    {
        $search = $request->query->get('search', array());
        $offset = $request->query->get('start', 0);
        $limit = $request->query->get('length', 30);
        $sort = $request->query->get('sort', null);
        $direction = $request->query->get('direction', null);
        return $this->handleView($this->view(array(
            'data' => $this->getDoctrine()->getRepository(Orders::class)->search($search["value"], $limit, $offset, $sort, $direction)->getQuery()->getResult(),
            'recordsTotal' => $this->getDoctrine()->getRepository(Orders::class)->total(),
            'recordsFiltered' => $this->getDoctrine()->getRepository(Orders::class)->searchTotal($search["value"], $limit, $offset),
            'offset' => $offset,
            'limit' => $limit,
        )));
    }

    public function postAction(Request $request){
        $entity = new Orders();
        $form = $this->createForm(OrderType::class, $entity);
        $form->submit(json_decode($request->getContent(), true));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $items=$request->get('items');
            foreach ($items as $key => $item) {
                $ordersItem=new OrdersItem();
                $ordersItem->setProductId($em->getRepository(Product::class)->find($item["id"]));
                $ordersItem->setOrderId($entity);
                $ordersItem->setCode($item["code"]);
                $ordersItem->setAmount($item["amount"]);
                $ordersItem->setDescription($item["name"]);
                $ordersItem->setPrice($item["price"]);
                $ordersItem->setSubtotal($item["price"]*$item["amount"]);
                $em->persist($ordersItem);
            }
            $em->flush();
            return $this->handleView($this->view($entity, Response::HTTP_OK));
        }
        return $this->handleView($this->view($form->getErrors(), Response::HTTP_BAD_REQUEST));
    }

    public function getAction($id){
        if (!$entity = $this->getDoctrine()->getRepository(Orders::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));

        return $this->handleView($this->view($entity));
    }
    
    public function emailAction($id){
        if (!$entity = $this->getDoctrine()->getRepository(Orders::class)->find($id))
            return $this->handleView($this->view(null, Response::HTTP_NOT_FOUND));

        //SEND EMAIL
        $settings = $this->container->get('setting');
        $message = (new \Swift_Message($this->get('setting')->getData()->getTitle().' - Pedido' ))
        ->setFrom(array($this->getParameter('mailer_user')=>$this->get('setting')->getData()->getTitle()))
        ->setTo($this->get('setting')->getData()->getOrdersEmail())
        ->setBody($this->renderView('InamikaBackOfficeBundle:Emails:Orders/sending.html.twig', array('entity' => $entity)),'text/html')
        // ->setBcc([
        //     $settings->getData()->getBillEmail()
        // ])
        ;
        $this->get('mailer')->send($message);
        return $this->handleView($this->view($entity));
    }

    public function deleteAction(Request $request, $id)
    {
        if (!$entity = $this->getDoctrine()->getRepository(Orders::class)->find($id))
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

}
