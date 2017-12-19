<?php

namespace AppBundle\Form;

use AppBundle\Entity\AssignmentEvent;
use AppBundle\Entity\Building;
use AppBundle\Entity\Room;
use DateInterval;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Time;

class AssignmentEventType extends AbstractType
{
    private $rooms;
    private $deadline;
    private $buildings;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->rooms = $options['rooms'];
        $this->deadline = $options['deadline'];
        $this->buildings = $options['buildings'];

        $builder
            ->add('start', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-timepicker'],
                'mapped' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Šis laukas privalomas']),
                    new Time(['message' => 'Šis laukas privalo būti laikas']),
                ],
                'label' => 'Pradžios laikas',
             ])
            ->add('end', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-timepicker'],
                'mapped' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Šis laukas privalomas']),
                    new Time(['message' => 'Šis laukas privalo būti laikas']),
                ],
                'label' => 'Pabaigos laikas',
            ])->add('building', ChoiceType::class, [
                'choices' => $this->buildings,
                'choice_label' => function ($building) {
                    /** @var Building $building */
                    return $building->getAddress();
                },
                'choice_attr' => function ($building) {
                    /** @var Building $building */
                    return ['class' => 'building_' . strtolower($building->getName())];
                },
                'mapped' =>false,
                'required' => false,
                'placeholder' => false,
                'label' => 'Pastatas',
            ]);
        $builder->get('building')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm()->getParent();
            $form->add('room', ChoiceType::class, [
                'choices' => $form->get('building')->getData()->getRooms(),
                'choice_label' => function ($room) {
                    /** @var Room $room */
                    return $room->getNo() . ' ' . $room->getBuilding()->getName();
                },
                'choice_attr' => function ($room) {
                    /** @var Room $room */
                    $roomName = $room->getNo() . ' ' . $room->getBuilding()->getName();

                    return ['class' => 'room_' . strtolower($roomName)];
                },
                'mapped' =>false,
                'constraints' => [
                    new NotBlank(['message' => 'Šis laukas privalomas']),
                    new Choice(array_values($this->rooms)),
                ],
                'label' => 'Kabinetas',
            ]);
        });
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssignmentEvent::class,
            'empty_data' => function (FormInterface $form) {
                if (!$form->get('start')->getData() ||
                    !$form->get('end')->getData() ||
                    !$form->get('room')->getData()) {
                    return null;
                }
                $start = $form->get('start')->getData();
                $end = $form->get('end')->getData();
                $room = $form->get('room')->getData();
                return new AssignmentEvent(
                    $this->timeToDate($start, $this->deadline),
                    $this->timeToDate($end, $this->deadline),
                    $room
                );
            }
        ]);
        $resolver->setRequired(['rooms', 'deadline', 'buildings']);
    }

    private function timeToDate(\DateTime $time, \DateTime $datetime): \DateTime
    {
        $interval = new DateInterval('PT' . $time->format('H') . 'H' . $time->format('i') . 'M');
        $date = clone $datetime;

        return $date->add($interval);
    }
}
