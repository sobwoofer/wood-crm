<?php

namespace App\Controller\Admin;

use App\Entity\Order;
use App\Entity\OrderProduct;
use App\Form\OrderProductFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('General information')->addCssClass('float-left col-sm-6'),
            AssociationField::new('manager')->setRequired(true),
            TextField::new('buyer_name'),

            TelephoneField::new('buyer_phone'),
            DateField::new('deadline'),
            ChoiceField::new('status')->setChoices([
                Order::STATUS_PENDING => Order::STATUS_PENDING,
                Order::STATUS_PROCESSING => Order::STATUS_PROCESSING,
                Order::STATUS_DONE => Order::STATUS_DONE,
                Order::STATUS_CANCELED => Order::STATUS_CANCELED,
            ]),
            ChoiceField::new('payment_status')->setChoices([
                Order::PAYMENT_STATUS_NOT_PAYED => Order::PAYMENT_STATUS_NOT_PAYED,
                Order::PAYMENT_STATUS_PREPAID => Order::PAYMENT_STATUS_PREPAID,
                Order::PAYMENT_STATUS_PAYED => Order::PAYMENT_STATUS_PAYED,
            ]),
            CollectionField::new('orderProducts')->setEntryType(OrderProductFormType::class),
            FormField::addPanel('Additional information')->addCssClass('float-left col-sm-6'),
            TextField::new('buyer_last_name'),
            TextField::new('buyer_address'),
            TextField::new('prepaid'),
            TextField::new('file'),
            BooleanField::new('active'),
//            DateField::new('shipped_date'),
            FormField::addPanel('Comments and descriptions')->collapsible()->renderCollapsed()
                                ->addCssClass('float-left col-sm-12'),
            TextEditorField::new('description'),
            TextEditorField::new('accountant_comment'),
            TextEditorField::new('manager_comment'),
            TextEditorField::new('supervisor_comment'),
        ];
    }

}
