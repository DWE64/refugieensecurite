<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureEditType;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_SUPER_ADMIN')]
#[Route('/picture')]
class PictureController extends AbstractController
{
    private $pictureRepository;

    public function __construct(PictureRepository $pictureRepository)
    {
        $this->pictureRepository = $pictureRepository;
    }

    #[Route('/', name: 'app_picture_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('picture/index.html.twig', [
            'pictures' => $this->pictureRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_picture_show', methods: ['GET'])]
    public function show(Picture $picture): Response
    {
        return $this->render('picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_picture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Picture $picture): Response
    {
        $form = $this->createForm(PictureEditType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->pictureRepository->add($picture);
            return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_picture_delete', methods: ['POST'])]
    public function delete(Request $request, Picture $picture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $this->pictureRepository->remove($picture);
        }

        return $this->redirectToRoute('app_picture_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/change_status/{id}', name: 'change_status', methods: ['POST'])]
    public function changeStatus(Picture $picture)
    {
        if($picture->getAccepted()){
            $picture->setAccepted(false);
            $picture->setDateRefused(new \DateTimeImmutable('now'));
        }else{
            $picture->setAccepted(true);
            $picture->setDateAccepted(new \DateTimeImmutable('now'));
        }
        $this->pictureRepository->add($picture);
        return new JsonResponse(['message'=>'changement effectué'],200, []);
    }
}
