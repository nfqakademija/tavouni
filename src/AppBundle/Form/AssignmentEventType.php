<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.12.16
 * Time: 21.56
 */

namespace AppBundle\Form;

use AppBundle\Entity\AssignmentEvent;
use AppBundle\Entity\Building;
use AppBundle\Entity\Room;
use DateInterval;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ])->add('end', TimeType::class, [
                'input'  => 'datetime',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-timepicker'],
                'mapped' => false,
            ])->add('building', ChoiceType::class, [
                'choices' => $this->buildings,
                'choice_label' => function ($building) {
                    /** @var Building $building */
                    return $building->getName();
                },
                'choice_attr' => function ($building) {
                    /** @var Building $building */
                    return ['class' => 'building_' . strtolower($building->getName())];
                },
                'mapped' =>false,
                'required' => false,
                'placeholder' => false,
            ]);
        $builder->get('building')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm()->getParent();
            $form->add('room', ChoiceType::class, [
                'choices' => $this->rooms,
                'choice_label' => function ($room) {
                    /** @var Room $room */
                    return $room->getNo() . ' ' . $room->getBuilding()->getName();
                },
                'choice_attr' => function ($room) {
                    /** @var Room $room */
                    $roomName = $room->getNo() . ' ' . $room->getBuilding()->getName();

                    return ['class' => 'room_' . strtolower($roomName)];
                },
                'mapped' =>false
            ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssignmentEvent::class,
            'empty_data' => function (FormInterface $form) {
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
