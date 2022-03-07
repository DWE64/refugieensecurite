<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('userSafe', TextType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'label'=>'user.safe.name',
            ])
            ->add('homeLocalisation',TextType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'label'=>'user.city.localisation',
            ])
            ->add('homeCountry',CountryType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-select'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'label'=>'user.country.localisation',
            ])
            ->add('cityBecoming', TextType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'label'=>'user.city.becoming',
            ])
            ->add('urlPicture',FileType::class, [
                'required'=>false,
                'mapped' => false,
                'attr'=>[
                    'placeholder'=>'Photo profil',
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '8M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif'
                        ],
                        'mimeTypesMessage' => 'file.message.upload',
                    ])
                ],
                'label'=>'user.safe.picture'
            ])
            ->add('save', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success col-lg-2 col-12'
                ],
                'label'=>'post.user.safe'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
