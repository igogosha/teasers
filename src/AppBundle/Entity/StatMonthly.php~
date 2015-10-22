<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stat
 *
 * @ORM\Table(name="stat_monthly")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity
 */
class StatMonthly
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
     * @ORM\OneToOne(targetEntity="Places")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     */
    private $place;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Rubrics")
     * @ORM\JoinColumn(name="rubric_id", referencedColumnName="id")
     */
    private $rubric;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="BlockSettings")
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
     * Set place
     *
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
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }


}
