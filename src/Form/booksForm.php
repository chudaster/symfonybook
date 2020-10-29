<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of booksForm
 *
 * @author Chudaster
 */
class BooksForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)  {
        $builder
            ->add('id', HiddenType::class,array(
        'data_class' => null,
        'mapped' => false,            
    ))
            ->add('name', TextType::class)
            ->add('years', TextType::class)
            ->add('autor', TextType::class)
            ->add('save', SubmitType::class)
                ;
    }

}
