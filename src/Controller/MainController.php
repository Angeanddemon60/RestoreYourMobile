<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\FaqRepository;
use App\Repository\HeroRepository;
use App\Repository\AboutRepository;
use App\Repository\ValueRepository;
use App\Repository\ContactRepository;
use App\Repository\FeatureRepository;
use App\Repository\ServiceRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(AboutRepository $aboutRepository, ContactRepository $contactRepository, FaqRepository $faqRepository, FeatureRepository $featureRepository, HeroRepository $heroRepository, ServiceRepository $serviceRepository, ValueRepository $valueRepository, Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid() ) {
        
            $name = $form->get('name')->getData(); 
            $email = $form->get('email')->getData(); 
            $object = $form->get('object')->getData();
            $message = $form->get('message')->getData(); 
            
            $emailToSend = (new TemplatedEmail())
            
            ->from($email)
            ->to('contact@laetitia-georgelin.fr')
            ->subject('Formulaire de contact')
            ->htmlTemplate('email/send.html.twig')
            ->context([
                'name' => $name,
                'mail' => $email,
                'object' => $object,
                'message' => $message,
            ]);
    
            $mailer->send($emailToSend);

            $mailConfirm = (new TemplatedEmail())

            ->from('contact@laetitia-georgelin.fr')
            ->to($email)
            ->subject('Restore Your Mobile - Confirmation de votre demande de contact')
            ->htmlTemplate('email/confirmation.html.twig')
            ->context([
                'name' => $name,
                'mail' => $email,
                'object' => $object,
                'message' => $message,
            ]);

            $mailer->send($mailConfirm);

            $this->addFlash(
                'success',
                'Votre message a bien été envoyé.'
            );

            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/index.html.twig', [
            'title' => "Accueil",
            'hero' => $heroRepository->findAll(),
            'about' => $aboutRepository->findAll(),
            'contact' => $contactRepository->findAll(),
            'faqs' => $faqRepository->findAll(),
            'features' => $featureRepository->findAll(),
            'services' => $serviceRepository->findAll(),
            'values' => $valueRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/mention-legale', name: 'app_legal')]
    public function legal(): Response
    {
        return $this->render('main/legal.html.twig', [
            'title' => "Mention légale",
        ]);
    }

    #[Route('/conditions-generales-vente', name: 'app_cgv')]
    public function cgv(): Response
    {
        return $this->render('main/cgv.html.twig', [
            'title' => "CGV",
        ]);
    }

    #[Route('/politique-confidentialite', name: 'app_privacyPolicy')]
    public function pc(): Response
    {
        return $this->render('main/privacyPolicy.html.twig', [
            'title' => "Politique de confidentialité",
        ]);
    }
}
