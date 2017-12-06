<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.12.4
 * Time: 23.18
 */

namespace AppBundle\Form;

use AppBundle\Entity\Assignment;
use AppBundle\Entity\AssignmentEvent;
use AppBundle\Entity\LectureType;
use AppBundle\Entity\Room;
use AppBundle\Entity\Subject;
use AppBundle\Repository\LectureTypeRepository;
use DateInterval;
use Ivory\CKEditorBundle\Exception\Exception;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssignmentType extends AbstractType
{
    /**
     * @var Subject
     */
    private $subject;
    private $lectureTypes;
    private $rooms;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->subject = $options['subject'];
        $this->lectureTypes = $options['lectureTypes'];
        $this->rooms = $options['rooms'];

        $builder
            ->add('weight')
            ->add('name')
            ->add('lectureType', ChoiceType::class, [
                'choices' => $this->lectureTypes,
                'choice_label' => function ($lectureType, $key, $index) {
                /** @var LectureType $lectureType */
                    return $lectureType->getName();
                },
                'choice_attr' => function ($lectureType, $key, $index) {
                    /** @var LectureType $lectureType */
                    return ['class' => 'lectureType_'.strtolower($lectureType->getName())];
                }
                ])
            ->add('deadline', DateType::class, array(
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker'],
                'format' => 'MM/dd/yyyy',
            ))
            ->add('moreOptions', CheckboxType::class, array(
                'attr' => ['checked' => false],
                'label' => 'Pridėti tikslų laiką',
                'required' => false,
                'mapped' => false
            ));

        $builder->get('moreOptions')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $checked = $event->getData();
            if ($checked) {
                $form = $event->getForm()->getParent();
                $form->add('rooms', ChoiceType::class, [
                    'choices' => $this->rooms,
                    'choice_label' => function ($room, $key, $index) {
                        /** @var Room $room */
                        return $room->getNo().' '.$room->getBuilding()->getName();
                    },
                    'choice_attr' => function ($room, $key, $index) {
                        /** @var Room $room */
                        $roomName = $room->getNo().' '.$room->getBuilding()->getName();
                        return ['class' => 'lectureType_'.strtolower($roomName)];
                    },
                    'mapped' =>false
                ])
                    ->add('start', TimeType::class, array(
                        'input'  => 'datetime',
                        'widget' => 'single_text',
                        'html5' => false,
                        'attr' => ['class' => 'js-timepicker'],
                        'mapped' => false,
                    ))->add('end', TimeType::class, array(
                        'input'  => 'datetime',
                        'widget' => 'single_text',
                        'html5' => false,
                        'attr' => ['class' => 'js-timepicker'],
                        'mapped' => false,
                    ));
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Assignment::class,
            'empty_data' => function (FormInterface $form) {
                $checked = $form->get('moreOptions')->getData();
                if ($checked) {
                    $start = $form->get('start')->getData();
                    $end = $form->get('end')->getData();
                    $room = $form->get('rooms')->getData();
                    $deadline = $form->get('deadline')->getData();
                    return new Assignment(
                        $this->subject,
                        $form->get('weight')->getData(),
                        $form->get('name')->getData(),
                        $form->get('lectureType')->getData(),
                        $deadline,
                        new AssignmentEvent(
                            $this->timeToDate($start, $deadline),
                            $this->timeToDate($end, $deadline),
                            $room
                        )
                    );
                }
                return new Assignment(
                    $this->subject,
                    $form->get('weight')->getData(),
                    $form->get('name')->getData(),
                    $form->get('lectureType')->getData(),
                    $form->get('deadline')->getData()
                );
            },
            'subject' => null,
            'lectureTypes' => null,
            'rooms' => null,
        ]);
    }
    private function timeToDate($time, $datetime)
    {
        $interval = new DateInterval('PT'.$time->format('H').'H'.$time->format('i').'M');
        $date = clone $datetime;
        return $date->add($interval);
    }
}
