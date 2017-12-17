<?php
/**
 * Created by PhpStorm.
 * User: ignas
 * Date: 17.12.16
 * Time: 21.56
 */

namespace AppBundle\Form;

use AppBundle\Entity\AssignmentEvent;
use AppBundle\Entity\Room;
use DateInterval;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssignmentEventType extends AbstractType
{
    private $rooms;
    private $deadline;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->rooms = $options['rooms'];
        $this->deadline = $options['deadline'];
        $builder
            ->add('rooms', ChoiceType::class, [
                'choices' => $this->rooms,
                'choice_label' => function ($room) {
                    /** @var Room $room */
                    return $room->getNo() . ' ' . $room->getBuilding()->getName();
                },
                'choice_attr' => function ($room) {
                    /** @var Room $room */
                    $roomName = $room->getNo() . ' ' . $room->getBuilding()->getName();

                    return ['class' => 'lectureType_' . strtolower($roomName)];
                },
                'mapped' =>false
            ])->add('start', TimeType::class, [
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssignmentEvent::class,
            'empty_data' => function (FormInterface $form) {
                $start = $form->get('start')->getData();
                $end = $form->get('end')->getData();
                $room = $form->get('rooms')->getData();
                return new AssignmentEvent(
                    $this->timeToDate($start, $this->deadline),
                    $this->timeToDate($end, $this->deadline),
                    $room
                );
            }
        ]);
        $resolver->setRequired(['rooms', 'deadline']);
    }

    private function timeToDate(\DateTime $time, \DateTime $datetime): \DateTime
    {
        $interval = new DateInterval('PT' . $time->format('H') . 'H' . $time->format('i') . 'M');
        $date = clone $datetime;

        return $date->add($interval);
    }
}
