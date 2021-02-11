<?php

namespace App\Form;

use App\Entity\OrderProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('fact_price')
            ->add('spent_itr')
            ->add('purchase')
            ->add('quantity')
            ->add('order')
            ->add('product')
            ->add('produceOrderProduct')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderProduct::class,
        ]);
    }
}
