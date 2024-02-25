<?php

namespace SymfonyModule\Controller;

use SymfonyModule\Form\YoutubeType;
use SymfonyModule\Entity\YoutubeComment;

use Db;

use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;

class YoutubeController extends FrameworkBundleAdminController
{   
    public function createAction(Request $request)
    {
        //$form = $this->createForm(YoutubeType::class, YoutubeComment object);
        $form = $this->createForm(YoutubeType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //$youtubeComment = $form->getData();
            //$youtubeComment->save();

            $youtubeComment = new YoutubeComment();
            $youtubeComment->setProductId(      $form->get('id_product')->getData());
            $youtubeComment->setCustomerName(   $form->get('customer_name')->getData());
            $youtubeComment->setTitle(          $form->get('title')->getData());
            $youtubeComment->setContent(        $form->get('content')->getData());
            $youtubeComment->setGrade(          $form->get('grade')->getData());

            $em->persist($youtubeComment);
            $em->flush();
        }

        return $this->render('@Modules/symfonymodule/templates/admin/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $data = $em->getRepository(YoutubeComment::class)->findAll();

        return $this->render('@Modules/symfonymodule/templates/admin/list.html.twig', [
            'data' => $data,
        ]);
    }
}
