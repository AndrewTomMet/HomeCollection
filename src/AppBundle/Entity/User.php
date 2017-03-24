<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @Assert\NotBlank(message = "user.name.not_blank")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="CollectionItem", mappedBy="user")
     */
    private $collectionItems;

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
     * @return User
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
     * Constructor
     */
    public function __construct()
    {
        $this->collectionItems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add collectionItem
     *
     * @param \AppBundle\Entity\CollectionItem $collectionItem
     *
     * @return User
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
