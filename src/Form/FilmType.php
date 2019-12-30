<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Nationalite;
use App\Entity\SpecialInfo;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('duree')
            ->add('resume')
            ->add('titreOriginal')
            ->add('affiche', FileType::class, [
                'label' => 'affiche',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // everytime you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/gif',
                            'image/x-icon'
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image document',
                    ])
                ],
            ])
            ->add('genres', EntityType::class, [
                'label'=>'genres',
                'class'=>Genre::class,
                'choice_label'=>'libelle',
                'multiple'=>true,
                'expanded'=> true
            ])
            ->add('nationalites', EntityType::class, [
                'label'=>'nationalites',
                'class'=>Nationalite::class,
                'choice_label'=>'libelle',
                'multiple'=>true,
                'expanded'=> true
            ])
            ->add('specialinfos', CollectionType::class, [
                'entry_type' => SpecialInfoFormType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
            'allow_extra_fields'=>true,
        ]);
    }
}
