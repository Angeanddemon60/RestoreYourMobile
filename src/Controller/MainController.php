<?php

namespace App\Controller;

use App\Repository\AboutRepository;
use App\Repository\ContactRepository;
use App\Repository\FaqRepository;
use App\Repository\FeatureRepository;
use App\Repository\HeroRepository;
use App\Repository\ServiceRepository;
use App\Repository\ValueRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(AboutRepository $aboutRepository, ContactRepository $contactRepository, FaqRepository $faqRepository, FeatureRepository $featureRepository, HeroRepository $heroRepository, ServiceRepository $serviceRepository, ValueRepository $valueRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'title' => "Accueil",
            'hero' => $heroRepository->findAll(),
            'about' => $aboutRepository->findAll(),
            'contact' => $contactRepository->findAll(),
            'faqs' => $faqRepository->findAll(),
            'features' => $featureRepository->findAll(),
            'services' => $serviceRepository->findAll(),
            'values' => $valueRepository->findAll(),
        ]);
    }
}
