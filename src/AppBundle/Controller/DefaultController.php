<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CollectionItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Ldap\Adapter\ExtLdap\Collection;

class DefaultController extends Controller
{
    /**
     * @Template()
     * @Route("/", name="collectionList")
     * @return array
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $collection = $em->getRepository(CollectionItem::class)->findAll();

        return ['collection' => $collection];
    }

    /**
     * @Template()
     * @Route("/show/{id}", name="show_item")
     * @param int $id
     * @return array
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $item = $em->getRepository(CollectionItem::class)->findOneBy(['id' => $id]);
        if (!$item) {
            throw new NotFoundHttpException("item with id ".$id." not founded!");
        }

        return ['item' => $item];
    }

    /**
     * @Template()
     * @Route("/video/{id}", name="video_item")
     * @param int $id
     * @return array
     */
    public function videoAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $item = $em->getRepository(CollectionItem::class)->findOneBy(['id' => $id]);
        if (!$item) {
            throw new NotFoundHttpException("item with id ".$id." not founded!");
        }

        return ['item' => $item];
    }
}
