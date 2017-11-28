<?php

namespace AppBundle\Form;

use AppBundle\Entity\Lecturer;
use AppBundle\Entity\Post;
use AppBundle\Entity\Subject;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * @var Subject
     */
    private $subject;
    /**
     * @var Lecturer
     */
    private $author;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->subject = $options['subject'];
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
                    new \DateTime(),
                    $this->subject,
                    $this->author
                );
            },
            'subject' => null,
            'author' => null
        ]);
    }
}
