<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Translation
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TranslationRepository")
 * @ORM\Table(name="translations")
 */
class Translation
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     * @Assert\NotBlank(message = "translation.name.not_blank")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="CollectionItem", inversedBy="translations")
     */
    private $collectionItems;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->collectionItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Translation
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add collectionItem
     *
     * @param \AppBundle\Entity\CollectionItem $collectionItem
     *
     * @return Translation
     */
    public function addCollectionItem(\AppBundle\Entity\CollectionItem $collectionItem)
    {
        $this->collectionItems[] = $collectionItem;

        return $this;
    }

    /**
     * Remove collectionItem
     *
     * @param \AppBundle\Entity\CollectionItem $collectionItem
     */
    public function removeCollectionItem(\AppBundle\Entity\CollectionItem $collectionItem)
    {
        $this->collectionItems->removeElement($collectionItem);
    }

    /**
     * Get collectionItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCollectionItems()
    {
        return $this->collectionItems;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
