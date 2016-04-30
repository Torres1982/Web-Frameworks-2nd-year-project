<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace Itb\Model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Project - manages the project's details
 * @package Itb
 */
class Project extends DatabaseTable
{
    //*********************************************
    //**************** VARIABLES ******************
    //*********************************************
    /**
     * Project id
     * @var integer
     */
    private $id;

    /**
     * Project name
     * @var string
     */
    private $projectName;

    /**
     * Project title
     * @var string
     */
    private $projectTitle;

    /**
     * Project status
     * @var string
     */
    private $projectStatus;

    /**
     * Project Supervisor
     * @var integer
     */
    private $projectSupervisor;

    //*********************************************
    //****************** GETTERS ******************
    //*********************************************
    /**
     * Get the project's id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the project's name
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Get the project's title
     * @return string
     */
    public function getProjectTitle()
    {
        return $this->projectTitle;
    }

    /**
     * Get the project's status
     * @return string
     */
    public function getProjectStatus()
    {
        return $this->projectStatus;
    }

    /**
     * Get the project's Supervisor
     * @return int
     */
    public function getProjectSupervisor()
    {
        return $this->projectSupervisor;
    }

    //*********************************************
    //****************** SETTERS ******************
    //*********************************************
    /**
     * Set the project's id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set the project's name
     * @param $projectName
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;
    }

    /**
     * Set the project's title
     * @param $projectTitle
     */
    public function setProjectTitle($projectTitle)
    {
        $this->projectTitle = $projectTitle;
    }

    /**
     * Set the project's status
     * @param $projectStatus
     */
    public function setProjectStatus($projectStatus)
    {
        $this->projectStatus = $projectStatus;
    }

    /**
     * Set the project's Supervisor
     * @param $projectSupervisor
     */
    public function setProjectSupervisor($projectSupervisor)
    {
        $this->projectSupervisor = $projectSupervisor;
    }
}
