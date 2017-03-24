<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\DBAL\Types\CollectionItemStatusType;

class CollectionItemAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'sonata_collection_item';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Інформація')
                ->with('Офіційна', ['class' => 'col-md-4'])
                    //->add('imageFile', 'file', ['required' => false, 'label' => 'постер'])
                    ->add('imageName', null, ['required' => false, 'label' => 'url постера'])
                    ->add('nameEng', null, ['label' => 'оригинальна назва'])
                    ->add('nameUkr', null, ['label' => 'переклад назви'])
                    ->add('year', null, ['label' => 'рік випуску'])
                ->end()
                ->with('Користувача', ['class' => 'col-md-4'])
                    ->add('pathLocal', null, ['label' => 'локальне розташування'])
                    ->add('pathDownload', null, ['label' => 'шлях завантаження'])
                    ->add('status', null, ['label' => 'статус'])
                    ->add('completedAt', 'date', [
                        'label' => 'дата статусу',
                        'widget' => 'text',
                        'required' => false,
                        'format' => 'd M y',
                        'placeholder' => 'd m y',
                    ])
                ->end()
                ->with('Рейтинги', ['class' => 'col-md-1'])
                    ->add('ratingImgb', null, ['label' => 'IMGM'])
                    ->add('ratingKinopoisk', null, ['label' => 'Кинопоиск'])
                    ->add('ratingOwn', null, ['label' => 'власний'])
                ->end()
                ->with('Тип', ['class' => 'col-md-3'])
                    ->add('itemType', 'sonata_type_model', ['label' => 'жанр', 'multiple' => true, 'required' => false])
                    ->add('translation', 'sonata_type_model', ['label' => 'переклад', 'multiple' => true, 'required' => false])
                ->end()
                ->with('Опис', ['class' => 'col-md-12'])
                    ->add('descriptionOfficial', null, ['label' => 'офіційний'])
                    ->add('descriptionMy', null, ['label' => 'власний'])
                ->end()
            ->end()
            ->tab('Загальна')
                ->add('collectionType', 'sonata_type_model', ['label' => 'тип колекціі'])
                ->add('user', 'sonata_type_model', ['label' => 'користувач'])
            ->end()->end()

            ->tab('Технічна інформація')
                ->add('resolution', 'sonata_type_model', ['label' => 'якість'])
                ->add('bitrate', null, ['label' => 'бітрейт'])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('collectionType', null, [], null, null, ['label' => 'тип колекціі'])
            ->add('nameEng', null, [], null, null, ['label' => 'оригинальна назва'])
            ->add('nameUkr', null, [], null, null, ['label' => 'переклад назви'])
            ->add('itemType', null, [], null, null, ['label' => 'жанр'])
            ->add('translation', null, [], null, null, ['label' => 'переклад'])
            ->add('user', null, [], null, null, ['label' => 'користувач'])
            ->add('year', null, [], null, null, ['label' => 'рік випуску'])
            ->add(
                'status',
                'doctrine_orm_choice',
                [],
                'choice',
                ['choices' => CollectionItemStatusType::getChoices()],
                ['label' => 'статус']
            )
            ->add('completedAt', null, [], null, null, ['label' => 'дата статусу'])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('imageFile')
            ->add('collectionType', null, ['label' => 'тип коллекціі'])
            ->addIdentifier('__toString', null, ['label' => 'назва'])
            ->add('translation', null, ['label' => 'переклади'])
            ->add('itemType', null, ['label' => 'жанр'])
            ->add('getStatusReadable', null, ['label' => 'статус'])
            ->add('completedAt', null, ['label' => 'дата статуса'])
            ->add('_action', 'actions', [
                'actions'   => [
                    'edit'      => [],
                    'delete'    => [],
                ],
            ])
        ;
    }
}
