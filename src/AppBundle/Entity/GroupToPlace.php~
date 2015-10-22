<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Places;
use AppBundle\Entity\Groups;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use AppBundle\Entity\User;

/**
 * GroupToPlace
 *
 * @ORM\Table(name="group_to_place")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GroupToPlaceRepository")
 */
class GroupToPlace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     **/
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Groups")
     * @ORM\JoinColumn(name="groups_id", referencedColumnName="id")
     *
     */
    private $groups;

    /**
     *
     * @ManyToOne(targetEntity="Places")
     * @JoinColumn(name="places_id", referencedColumnName="id")
     */
    private $places;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
     * Set groups
     *
     * @return GroupToPlace
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }


    /**
     * Get groups
     *
     * @return Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Set places
     *
     * @return GroupToPlace
     */
    public function setPlaces($places)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get placesId
     *
     * @return integer 
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return GroupToPlace
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set user
     *
     * @return User
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
