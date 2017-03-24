<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TranslationAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('collectionItems', 'entity', ['class' => 'AppBundle\Entity\CollectionItem', 'required' => false, 'multiple' => true])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('collectionItems', null, [], 'entity', ['class' => 'AppBundle\Entity\CollectionItem', 'required' => false, 'multiple' => true])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('collectionItems', 'entity', ['class' => 'AppBundle\Entity\CollectionItem', 'required' => false, 'multiple' => true])
        ;
    }
}
