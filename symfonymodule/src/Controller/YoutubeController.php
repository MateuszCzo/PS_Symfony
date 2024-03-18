<?php

namespace SymfonyModule\Controller;

use SymfonyModule\Entity\YoutubeComment;
use SymfonyModule\Form\YoutubeType;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class YoutubeController extends FrameworkBundleAdminController
{   
    public function createAction(Request $request): Response
    {
        $youtubeComment = new YoutubeComment();
 
        $form = $this->createForm(YoutubeType::class, $youtubeComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($youtubeComment);
            $entityManager->flush();

            $this->addFlash('notice', $this->trans('Youtube comment created successfuly.', 'Modules.SymfonyModule.YoutubeController'));

            return $this->redirectToRoute('symfonymodule_youtube_list');
        }

        return $this->render('@Modules/symfonymodule/views/templates/admin/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function listAction(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $youtubeComments = $entityManager->getRepository(YoutubeComment::class)->findAll();

        return $this->render('@Modules/symfonymodule/views/templates/admin/list.html.twig', [
            'youtubeComments' => $youtubeComments,
        ]);
    }

    public function deleteAction(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $youtubeComment = $entityManager->getRepository(YoutubeComment::class)->find($id);

        if ($youtubeComment) {
            $entityManager->remove($youtubeComment);
            $entityManager->flush();
        }
        $this->addFlash('notice', $this->trans('Your changes were saved.', 'Modules.SymfonyModule.YoutubeController'));

        return $this->redirectToRoute('symfonymodule_youtube_list');
    }

    public function updateAction(Request $request, int $id): Response
    {
        if ($id === null) {
            $this->addFlash('notice', $this->trans('No id given.', 'Modules.SymfonyModule.YoutubeController'));

            return $this->redirectToRoute('symfonymodule_youtube_list');
        }

        $entityManager = $this->getDoctrine()->getManager();

        $youtubeComment = $entityManager->getRepository(YoutubeComment::class)->find($id);

        if (!$youtubeComment) {
            $this->addFlash('notice', $this->trans('No youtube comment found.', 'Modules.SymfonyModule.YoutubeController'));

            return $this->redirectToRoute('symfonymodule_youtube_list');
        }

        $form = $this->createForm(YoutubeType::class, $youtubeComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($youtubeComment);
            $entityManager->flush();

            $this->addFlash('notice', $this->trans('Youtube comment updated successfuly.', 'Modules.SymfonyModule.YoutubeController'));

            return $this->redirectToRoute('symfonymodule_youtube_list');
        }

        return $this->render('@Modules/symfonymodule/views/templates/admin/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
