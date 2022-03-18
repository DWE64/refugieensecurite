<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class MentionLegaleController extends AbstractController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    #[Route('/mentions_legales', name: 'app_mentions_legales')]
    public function index(): Response
    {
        return $this->render('mention_legale/index.html.twig', [
            'controller_name' => $this->translator->trans('mentions.legales'),
        ]);
    }
}
