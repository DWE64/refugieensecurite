<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use App\Services\UploadFileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        PictureRepository $pictureRepository,
        UploadFileService $uploadFileService,
    ): Response
    {

        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filename = $form->get('urlPicture')->getData();
            if($filename){
                $newFilename = $uploadFileService->uploadFile($filename);
                if(null === $newFilename)
                {
                    return $this->redirectToRoute('app_home', [], Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
                }
                $picture->setUrlPicture($newFilename);
            }
            $pictureRepository->add($picture);
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('home/index.html.twig', [
            'controller_name' => $this->translator->trans('page.home'),
            'formUserSafe' => $form->createView(),
            'listUsersSafes' => $pictureRepository->findAll()
        ]);
    }

    #[Route('/change_locale/{locale}', name:'change_locale')]
    public function changeLocale($locale, Request $request)
    {
        $request->getSession()->set('_locale',$locale);

        return $this->redirect($request->headers->get('referer'));
    }
}
