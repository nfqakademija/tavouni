<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.12.4
 * Time: 23.18
 */

namespace AppBundle\Form;


use AppBundle\Entity\Assignment;
use AppBundle\Entity\LectureType;
use AppBundle\Entity\Subject;
use AppBundle\Repository\LectureTypeRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssignmentType extends AbstractType
{
    /**
     * @var Subject
     */
    private $subject;
    private $lectureTypes;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->subject = $options['subject'];
        $this->lectureTypes = $options['lectureTypes'];

        $builder
            ->add('weight')
            ->add('name')
            ->add('lectureType', ChoiceType::class, [
                'choices' => $this->lectureTypes,
                'choice_label' => function ($lectureType, $key, $index) {
                /** @var LectureType $lectureType */
                return $lectureType->getName();
                },
                'choice_attr' => function($lectureType, $key, $index) {
                    /** @var LectureType $lectureType */
                    return ['class' => 'lectureType_'.strtolower($lectureType->getName())];
                }
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Assignment::class,
            'empty_data' => function (FormInterface $form) {
                return new Assignment(
                    $this->subject,
                    $form->get('weight')->getData(),
                    $form->get('name')->getData(),
                    $form->get('lectureType')->getData()
                );
            },
            'subject' => null,
            'lectureTypes' => null
        ]);
    }
}