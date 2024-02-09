<?php

namespace App\Form;

use App\Entity\CaseStudy;
use App\Entity\Customer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CaseStudyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class, [
                'attr' => ['rows' => 4, 'cols' => 50, 'class' => 'no-resize'],
            ])
            ->add('pictureFile', VichImageType::class, [
                'allow_delete' => false,
                'download_uri' => false,
                'download_label' => 'download_file',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CaseStudy::class,
        ]);
    }
}
