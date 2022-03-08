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
use Symfony\Contracts\Translation\TranslatorInterface;

class PictureType extends AbstractType
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

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
                'label'=>$this->translator->trans('user.safe.name'),
            ])
            ->add('homeLocalisation',TextType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'label'=>$this->translator->trans('user.city.localisation'),
            ])
            ->add('homeCountry',CountryType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-select'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'label'=>$this->translator->trans('user.country.localisation'),
            ])
            ->add('cityBecoming', TextType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label_attr'=>[
                    'class'=>'form-label'
                ],
                'label'=>$this->translator->trans('user.city.becoming'),
            ])
            ->add('urlPicture',FileType::class, [
                'required'=>false,
                'mapped' => false,
                'attr'=>[
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
                        'mimeTypesMessage' => $this->translator->trans('file.message.upload'),
                    ])
                ],
                'label'=>$this->translator->trans('user.safe.picture')
            ])
            ->add('save', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-success col-lg-2 col-12'
                ],
                'label'=>$this->translator->trans('post.user.safe')
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
