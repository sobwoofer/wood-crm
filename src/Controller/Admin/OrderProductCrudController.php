<?php

namespace App\Controller\Admin;

use App\Entity\OrderProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class OrderProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrderProduct::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('product'),
            AssociationField::new('order'),
            CurrencyField::new('price'),
            CurrencyField::new('fact_price'),
            CurrencyField::new('spent_itr'),
            CurrencyField::new('purchase'),
            IntegerField::new('quantity'),
        ];
    }

}
