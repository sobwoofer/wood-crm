<?php

namespace App\Controller\Admin;

use App\Entity\OrderProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderProduct::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('product'),
            AssociationField::new('order'),
            IntegerField::new('price'),
            IntegerField::new('fact_price'),
            IntegerField::new('spent_itr'),
            IntegerField::new('purchase'),
            IntegerField::new('quantity'),
        ];
    }

}
