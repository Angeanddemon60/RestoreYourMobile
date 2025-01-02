<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Entity\Contact;
use App\Entity\Faq;
use App\Entity\Feature;
use App\Entity\Hero;
use App\Entity\Service;
use App\Entity\Value;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            
            'user' => $this->getUser(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('<img src="/assets/img/logo.png" width="150">')
            ->setFaviconPath('/assets/img/logo.png')
            ->setTranslationDomain('fr');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('En-tête', 'fas fa-window-maximize', Hero::class)
            ->setAction('detail')
            ->setEntityId(1);
        yield MenuItem::linkToCrud('À propos', 'fas fa-user', About::class)
            ->setAction('detail')
            ->setEntityId(1);
        yield MenuItem::linkToCrud('Valeurs', 'fas fa-heart', Value::class);
        yield MenuItem::linkToCrud('Fonctionnalités', 'fas fa-file', Feature::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-concierge-bell', Service::class);
        yield MenuItem::linkToCrud('FAQ', 'fas fa-question-circle', Faq::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-address-card', Contact::class)
            ->setAction('detail')
            ->setEntityId(1);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('assets/css/admin.css');
    }
}
