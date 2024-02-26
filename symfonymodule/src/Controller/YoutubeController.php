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
            $youtubeComment->setProductId(      $form->get('productId')->getData());
            $youtubeComment->setCustomerName(   $form->get('customerName')->getData());
            $youtubeComment->setTitle(          $form->get('title')->getData());
            $youtubeComment->setContent(        $form->get('content')->getData());
            $youtubeComment->setGrade(          $form->get('grade')->getData());
            $em->persist($youtubeComment);
            $em->flush();
            $this->addFlash(
                'notice',
                'Youtube comment created successfuly.'
            );
            return $this->redirectToRoute('youtube_list');
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

    public function deleteAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $youtubeComment = $em->getRepository(YoutubeComment::class)->find($id);
        if ($youtubeComment) {
            $em->remove($youtubeComment);
            $em->flush();
        }
        $this->addFlash(
            'notice',
            'Your changes were saved!'
        );

        return $this->redirectToRoute('youtube_list');
    }

    public function updateAction(Request $request, int $id)
    {
        if ($id === null) {
            $this->addFlash(
                'notice',
                'No id given.'
            );
            return $this->redirectToRoute('youtube_list');
        }
        $em = $this->getDoctrine()->getManager();
        $youtubeComment = $em->getRepository(YoutubeComment::class)->find($id);
        if (!$youtubeComment) {
            $this->addFlash(
                'notice',
                'No youtube comment found.'
            );
            return $this->redirectToRoute('youtube_list');
        }
        $form = $this->createForm(YoutubeType::class, $youtubeComment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $youtubeComment->setProductId(      $form->get('productId')->getData());
            $youtubeComment->setCustomerName(   $form->get('customerName')->getData());
            $youtubeComment->setTitle(          $form->get('title')->getData());
            $youtubeComment->setContent(        $form->get('content')->getData());
            $youtubeComment->setGrade(          $form->get('grade')->getData());
            $em->flush();
            $this->addFlash(
                'notice',
                'Youtube comment updated successfuly.'
            );
            return $this->redirectToRoute('youtube_list');
        }

        return $this->render('@Modules/symfonymodule/templates/admin/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
