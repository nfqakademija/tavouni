<?php

namespace AppBundle\Datatables;

use Sg\DatatablesBundle\Datatable\AbstractDatatable;
use Sg\DatatablesBundle\Datatable\Style;
use Sg\DatatablesBundle\Datatable\Column\Column;
use Sg\DatatablesBundle\Datatable\Column\BooleanColumn;
use Sg\DatatablesBundle\Datatable\Column\ActionColumn;
use Sg\DatatablesBundle\Datatable\Column\MultiselectColumn;
use Sg\DatatablesBundle\Datatable\Column\VirtualColumn;
use Sg\DatatablesBundle\Datatable\Column\DateTimeColumn;
use Sg\DatatablesBundle\Datatable\Column\ImageColumn;
use Sg\DatatablesBundle\Datatable\Filter\TextFilter;
use Sg\DatatablesBundle\Datatable\Filter\NumberFilter;
use Sg\DatatablesBundle\Datatable\Filter\SelectFilter;
use Sg\DatatablesBundle\Datatable\Filter\DateRangeFilter;
use Sg\DatatablesBundle\Datatable\Editable\CombodateEditable;
use Sg\DatatablesBundle\Datatable\Editable\SelectEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextareaEditable;
use Sg\DatatablesBundle\Datatable\Editable\TextEditable;

/**
 * Class AssignmentDatatable
 *
 * @package AppBundle\Datatables
 */
class AssignmentDatatable extends AbstractDatatable
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->language->set(array(
            'cdn_language_by_locale' => true
            //'language' => 'de'
        ));

        $this->ajax->set(array(
        ));

        $this->options->set(array(
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'order_cells_top' => true,
        ));

        $this->features->set(array(
        ));

        $this->columnBuilder
            ->add('id', Column::class, array(
                'title' => 'Id',
                ))
            ->add('weight', Column::class, array(
                'title' => 'Weight',
                ))
            ->add('name', Column::class, array(
                'title' => 'Name',
                ))
            ->add('deadline', Column::class, array(
                'title' => 'Deadline',
                ))
            ->add('subject.id', Column::class, array(
                'title' => 'Subject Id',
                ))
            ->add('subject.subjectType', Column::class, array(
                'title' => 'Subject SubjectType',
                ))
            ->add('subject.name', Column::class, array(
                'title' => 'Subject Name',
                ))
            ->add('lectureType.id', Column::class, array(
                'title' => 'LectureType Id',
                ))
            ->add('lectureType.name', Column::class, array(
                'title' => 'LectureType Name',
                ))
            ->add('grades.value', Column::class, array(
                'title' => 'Grades Value',
                'data' => 'grades[, ].value'
                ))
            ->add('assignmentEvent.id', Column::class, array(
                'title' => 'AssignmentEvent Id',
                ))
            ->add('assignmentEvent.start', Column::class, array(
                'title' => 'AssignmentEvent Start',
                ))
            ->add('assignmentEvent.end', Column::class, array(
                'title' => 'AssignmentEvent End',
                ))
            ->add(null, ActionColumn::class, array(
                'title' => $this->translator->trans('sg.datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'assignment_show',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => $this->translator->trans('sg.datatables.actions.show'),
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('sg.datatables.actions.show'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    ),
                    array(
                        'route' => 'assignment_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => $this->translator->trans('sg.datatables.actions.edit'),
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('sg.datatables.actions.edit'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    )
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'AppBundle\Entity\Assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'assignment_datatable';
    }
}
