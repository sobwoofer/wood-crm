<?php

namespace App\Controller\Admin;

use App\Entity\ProduceOrderProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduceOrderProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProduceOrderProduct::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
