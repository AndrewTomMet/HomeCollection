<?php

namespace AppBundle\Admin;

use AppBundle\DBAL\Types\CollectionItemTagType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CollectionTypeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('type', null, ['label' => 'тип'])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add(
                'type',
                'doctrine_orm_choice',
                [],
                'choice',
                ['choices' => CollectionItemTagType::getChoices()],
                ['label' => 'тип']
            )
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('getTypeReadable', null, ['label' => 'тип'])
        ;
    }
}
