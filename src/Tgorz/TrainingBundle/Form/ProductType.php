<?php

namespace Tgorz\TrainingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tgorz\TrainingBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('name',null,[
                    'label' => 'nazwa'
                ])
                ->add('price', null, [
                    'label' => 'cena'
                ])
                ->add('category', EntityType::class, [
                    'class' => 'TgorzTrainingBundle:Category',
                    'label' => 'kategoria'
                ])
                ->add('description', null, [
                    'label' => 'opis'
                ])
                ->add('submit', SubmitType::class,[
                    'label' => 'zapisz'
                ])
            ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class
        ));
    }

    


}
