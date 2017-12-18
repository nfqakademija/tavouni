<?php

namespace AppBundle\Form;

use AppBundle\Entity\Assignment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Range;

class AssignmentType extends AbstractType
{
    private $subject;
    private $rooms;
    private $buildings;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->subject = $options['subject'];
        $this->rooms = $options['rooms'];
        $this->buildings = $options['buildings'];
        $builder
            ->add('weight', null, [
                'constraints' => [
                    new Range(['min' => 0, 'max' => 100]),
                    new NotNull(),
                    new NotBlank(),
                ],
                //'empty_data' => 'x',
            ])
            ->add('name', null, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ]
            ])
            ->add('lectureType', ChoiceType::class, [
                'choices' => Assignment::LECTURE_TYPES,
                'constraints' => new Choice(array_values(Assignment::LECTURE_TYPES)),
            ])
            ->add('deadline', DateType::class, [
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'MM/dd/yyyy',
                'required' => true,
                'constraints' => [
                    new DateTime(),
                    new NotBlank(),
                ]
            ])
            ->add('moreOptions', CheckboxType::class, [
                'attr' => ['checked' => false],
                'label' => 'Pridėti tikslų laiką',
                'required' => false,
                'mapped' => false
            ]);
        $builder->get('moreOptions')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $checked = $event->getData();
            if ($checked) {
                $form = $event->getForm()->getParent();
                $form->add('assignmentEvent', AssignmentEventType::class, [
                    'rooms' => $this->rooms,
                    'deadline' => $form->get('deadline')->getData(),
                    'buildings' => $this->buildings
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Assignment::class,
            'empty_data' => function (FormInterface $form) {
                $checked = $form->get('moreOptions')->getData();
                $assignmentEvent = null;
                if ($checked) {
                    $assignmentEvent = $form->get('assignmentEvent')->getData();
                }

                return new Assignment(
                    $this->subject,
                    $form->get('weight')->getData(),
                    $form->get('name')->getData(),
                    $form->get('lectureType')->getData(),
                    $form->get('deadline')->getData(),
                    $assignmentEvent
                );
            }
        ]);
        $resolver->setRequired(['subject', 'rooms', 'buildings']);
    }
}
