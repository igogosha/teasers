<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stat
 *
 * @ORM\Table(name="stat")
 * @ORM\Entity
 */
class Stat
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
     * @var integer
     *
     * @ORM\Column(name="place_id", type="integer")
     */
    private $place;

    /**
     * @var integer
     *
     * @ORM\Column(name="rubric_id", type="integer")
     */
    private $rubric;

    /**
     * @ORM\ManyToOne(targetEntity="Teasers", inversedBy="stats")
     * @ORM\JoinColumn(name="teasers_id", referencedColumnName="id")
     */
    private $teasers;

    /**
     * @ORM\ManyToOne(targetEntity="BlockSettings", inversedBy="stats")
     * @ORM\JoinColumn(name="block_settings_id", referencedColumnName="id")
     */
    private $blockSettings;

    /**
     * @var integer
     *
     * @ORM\Column(name="views", type="integer")
     */
    private $views;

    /**
     * @var integer
     *
     * @ORM\Column(name="clicks", type="integer")
     */
    private $clicks;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date")
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
     * Set blockSettings
     *
     * @param integer $blockSettings
     * @return Stat
     */
    public function setBlockSettings($blockSettings)
    {
        $this->blockSettings = $blockSettings;

        return $this;
    }

    /**
     * Get blockSettings
     *
     * @return integer 
     */
    public function getBlockSettings()
    {
        return $this->blockSettings;
    }

    /**
     * Set views
     *
     * @param integer $views
     * @return Stat
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set clicks
     *
     * @param integer $clicks
     * @return Stat
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * Get clicks
     *
     * @return integer 
     */
    public function getClicks()
    {
        return $this->clicks;
    }



//    /**
//     * @ORM\PrePersist
//     */
//    public function setCreatedAtValue()
//    {
//        $this->createdAt = new \DateTime();
//    }



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Stat
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
     * Set place
     *
     * @param integer $place
     * @return Stat
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return integer 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set rubric
     *
     * @param integer $rubric
     * @return Stat
     */
    public function setRubric($rubric)
    {
        $this->rubric = $rubric;

        return $this;
    }

    /**
     * Get rubric
     *
     * @return integer 
     */
    public function getRubric()
    {
        return $this->rubric;
    }

    /**
     * Set teasers
     *
     * @param \AppBundle\Entity\Teasers $teasers
     * @return Stat
     */
    public function setTeasers(\AppBundle\Entity\Teasers $teasers = null)
    {
        $this->teasers = $teasers;

        return $this;
    }

    /**
     * Get teasers
     *
     * @return \AppBundle\Entity\Teasers 
     */
    public function getTeasers()
    {
        return $this->teasers;
    }
}
