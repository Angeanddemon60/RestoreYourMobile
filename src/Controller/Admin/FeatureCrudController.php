<?php

namespace App\Controller\Admin;

use App\Entity\Feature;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FeatureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Feature::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('description'),
            TextField::new('icon', 'Icône'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Fonctionnalité')
            ->setEntityLabelInPlural('Fonctionnalités')
            ->showEntityActionsInlined()
        ;
    }
}
