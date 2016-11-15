<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 12/11/2016
 * Time: 11:56
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="project")
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $supervizor;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $projectLeader;

    /**
     * @ORM\Column(type="integer")
     */
    private $projectSecretary;

    /**
     * @ORM\Column(type="string")
     */
    private $startDate;

    /**
     * @ORM\Column(type="string")
     */
    private $endDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isLocked = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSupervizor()
    {
        return $this->supervizor;
    }

    /**
     * @param mixed $supervizor
     */
    public function setSupervizor($supervizor)
    {
        $this->supervizor = $supervizor;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getProjectLeader()
    {
        return $this->projectLeader;
    }

    /**
     * @param mixed $projectLeader
     */
    public function setProjectLeader($projectLeader)
    {
        $this->projectLeader = $projectLeader;
    }

    /**
     * @return mixed
     */
    public function getProjectSecretary()
    {
        return $this->projectSecretary;
    }

    /**
     * @param mixed $projectSecretary
     */
    public function setProjectSecretary($projectSecretary)
    {
        $this->projectSecretary = $projectSecretary;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return boolean
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * @param boolean $isLocked
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;
    }


}