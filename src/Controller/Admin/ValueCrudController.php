<?php

namespace App\Controller\Admin;

use App\Entity\Value;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ValueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Value::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextField::new('description'),
            ImageField::new('image')
                ->setBasePath('assets/img/')
                ->setUploadDir('public/assets/img/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Valeur')
            ->setEntityLabelInPlural('Valeurs')
            ->showEntityActionsInlined()
        ;
    }
}
