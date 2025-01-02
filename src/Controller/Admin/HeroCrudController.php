<?php

namespace App\Controller\Admin;

use App\Entity\Hero;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HeroCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hero::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::DELETE, Action::NEW, Action::INDEX)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('subtitle', 'Sous-titre'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('En-tête')
            ->setEntityLabelInPlural('En-têtes')
            ->showEntityActionsInlined()
        ;
    }
}
