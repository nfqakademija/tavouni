<?php

namespace AppBundle\Form;

use AppBundle\Entity\Lecture;
use AppBundle\Entity\Lecturer;
use AppBundle\Entity\Post;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PostType extends AbstractType
{
    /**
     * @var Lecture
     */
    private $lecture;

    /**
     * @var Lecturer
     */
    private $author;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->lecture = $options['lecture'];
        $this->author = $options['author'];

        $builder
            ->add('title', null, [
                'constraints' => [
                    new NotBlank(['message' => 'Šis laukas privalomas']),
                    new Length([
                        'min' => 3,
                        'max' => 20,
                        'minMessage' => 'Pavadinimą turi sudaryti bent 3 simboliai',
                        'maxMessage' => 'Pavadinimas negali būti ilgesnis nei 20 simbolių'
                    ]),
                ],
                'label' => 'Pavadinimas',
            ])
            ->add('content', CKEditorType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Šis laukas privalomas']),
                ],
                'label' => 'Turinys',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => ['novalidate'=>'novalidate'],
            'data_class' => Post::class,
            'empty_data' => function (FormInterface $form) {
                if (!$form->get('title')->getData() || !$form->get('content')->getData()) {
                    return null;
                }
                return new Post(
                    $form->get('title')->getData(),
                    $form->get('content')->getData(),
                    $this->lecture,
                    $this->author
                );
            },
            'lecture' => null,
            'author' => null
        ]);
    }
}
