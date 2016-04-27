<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace Itb\model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Member - manages the member's details
 * @package Itb
 */
class Member extends DatabaseTable
{
    //*********************************************
    //**************** VARIABLES ******************
    //*********************************************
    /**
     * member id
     * @var int
     */
    private $id;

    /**
     * member name
     * @var string
     */
    private $memberName;

    /**
     * member second name
     * @var string
     */
    private $memberSurname;

    /**
     * project id
     * @var integer
     */
    private $projectId;

    /**
     * member email
     * @var string
     */
    private $email;

    /**
     * member status (current or past member)
     * @var string
     */
    private $memberStatus;

    //*********************************************
    //****************** GETTERS ******************
    //*********************************************
    /**
     * get the member's id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get the member's first name
     * @return string
     */
    public function getMemberName()
    {
        return $this->memberName;
    }

    /**
     * get the member's second name
     * @return string
     */
    public function getMemberSurname()
    {
        return $this->memberSurname;
    }

    /**
     * get the project's id
     * @return integer
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * get the member's email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * get the member's status
     * @return string
     */
    public function getMemberStatus()
    {
        return $this->memberStatus;
    }

    //*********************************************
    //****************** SETTERS ******************
    //*********************************************
    /**
     * set the member's id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * set the member's first name
     * @param $memberName
     */
    public function setMemberName($memberName)
    {
        $this->memberName = $memberName;
    }

    /**
     * set the member's second name
     * @param $memberSurname
     */
    public function setMemberSurname($memberSurname)
    {
        $this->memberSurname = $memberSurname;
    }

    /**
     * set the project's id
     * @param $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * set the member's email
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * set the member's status
     * @param $memberStatus
     */
    public function setMemberStatus($memberStatus)
    {
        $this->memberStatus = $memberStatus;
    }
}
