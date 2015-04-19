<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\BlockSettings;
use AppBundle\Entity\Places;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * BlockToPlace
 *
 * @ORM\Table(name="block_to_place")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BlockToPlaceRepository")
 */
class BlockToPlace
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
     *
     * @ManyToOne(targetEntity="BlockSettings")
     * @JoinColumn(name="block_id", referencedColumnName="id")
     **/
    private $block;

    /**
     *
     * @ManyToOne(targetEntity="Places")
     * @JoinColumn(name="place_id", referencedColumnName="id")
     **/
    private $place;

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
     * Set block
     *
     * @param integer $block
     * @return BlockSettings
     */
    public function setBlock($block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * Get block
     *
     * @return BlockSettings
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * Set place
     *
     * @param integer $place
     * @return Places
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get placeId
     *
     * @return Places
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return BlockToPlace
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
}
