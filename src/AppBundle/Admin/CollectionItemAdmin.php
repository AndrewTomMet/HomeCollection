<?php

namespace AppBundle\Admin;

use AppBundle\AppBundle;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CollectionItemAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Інформація')
                ->with('Офіційна', ['class' => 'col-md-4'])
                    ->add('image')
                    ->add('nameEng')
                    ->add('nameUkr')
                    ->add('year')
                    ->add('itemTypes', 'entity', ['class' => 'AppBundle\Entity\ItemType', 'multiple' => true, 'required' => false] )
                    ->add('translations', 'entity', ['class' => 'AppBundle\Entity\Translation', 'multiple' => true, 'required' => false] )
                    ->add('descriptionOfficial')
                ->end()
                ->with('Рейтинги', ['class' => 'col-md-4'])
                    ->add('ratingImgb')
                    ->add('ratingKinopoisk')
                ->end()
                ->with('Користувача', ['class' => 'col-md-4'])
                    ->add('ratingOwn')
                    ->add('pathLocal')
                    ->add('pathDownload')
                    ->add('descriptionMy')
                    ->add('completed')
                    ->add('completedAt', 'date', ['widget' => 'text', 'required' => false, 'format' => 'd M y', 'placeholder' => 'd m y'])
                ->end()
            ->end()

            ->tab('Загальна')
                ->add('collectionType', 'sonata_type_model')
                ->add('user', 'sonata_type_model')
            ->end()->end()

            ->tab('Технічна інформація')
                ->add('resolution', 'sonata_type_model')
                ->add('bitrate')
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('nameEng');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('collectionType', null, ['label' => 'тип коллекціі'])
            ->addIdentifier('nameEng', null, ['label' => 'оригінальна назва'])
            ->add('year', null, ['label' => 'рік створення', 'align' => 'center'])
            ->add('completed', null, ['label' => 'ознака завершення', 'align' => 'center'])
        ;
    }
}
