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
            ->add('title')
            ->add('content', CKEditorType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
            'empty_data' => function (FormInterface $form) {
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
