<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\DBAL\Types\CollectionItemStatusType;

class CollectionItemAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Інформація')
                ->with('Офіційна', ['class' => 'col-md-4'])
                    ->add('imageFile', 'file', ['required' => false])
                    ->add('nameEng')
                    ->add('nameUkr')
                    ->add('year')
                    ->add('itemType', 'sonata_type_model', ['multiple' => true, 'required' => false] )
                    ->add('translation', 'sonata_type_model', ['multiple' => true, 'required' => false] )
                    ->add('descriptionOfficial')
                ->end()
                ->with('Рейтинги', ['class' => 'col-md-2'])
                    ->add('ratingImgb')
                    ->add('ratingKinopoisk')
                    ->add('ratingOwn')
                ->end()
                ->with('Користувача', ['class' => 'col-md-4'])

                    ->add('pathLocal')
                    ->add('pathDownload')
                    ->add('descriptionMy')
                    ->add('status')
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
        $datagridMapper
            ->add('collectionType')
            ->add('nameEng')
            ->add('nameUkr')
            ->add('itemType')
            ->add('translation')
            ->add('user')
            ->add('year')
            ->add(
                'status',
                'doctrine_orm_choice',
                [],
                'choice',
                ['choices' => CollectionItemStatusType::getChoices()])
            ->add('completedAt')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('imageFile')
            ->add('collectionType', null, ['label' => 'тип коллекціі'])
            ->addIdentifier('nameEng', null, ['label' => 'оригінальна назва'])
            ->addIdentifier('nameUkr', null, ['label' => 'переклад назви'])
            ->add('year', null, ['label' => 'рік створення'])
            ->add('user')
            ->add('translation')
            ->add('itemType')
            ->add('getStatusReadable')
            ->add('completedAt')
            ->add('_action', 'actions', [
                'actions'   => [
                    'edit'      => [],
                    'delete'    => [],
                ],
            ])
        ;
    }
}
