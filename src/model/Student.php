<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace Itb\Model;

use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;

/**
 * Class Student - manages the student's personal details
 * @package Itb
 */
class Student extends DatabaseTable
{
    //*********************************************
    //**************** VARIABLES ******************
    //*********************************************
    /**
     * student's id
     * @var integer
     */
    private $id;

    /**
     * student's first name
     * @var string
     */
    private $studentName;

    /**
     * student's second name
     * @var string
     */
    private $studentSurname;

    /**
     * project's id
     * @var integer
     */
    private $projectId;

    /**
     * student's email
     * @var string
     */
    private $email;

    /**
     * member's id
     * @var integer
     */
    private $memberId;

    /**
     * default profile image name
     * @var string
     */
    private $imageName;

    //*********************************************
    //****************** GETTERS ******************
    //*********************************************
    /**
     * get the student's id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get the student's first name
     * @return string
     */
    public function getStudentName()
    {
        return $this->studentName;
    }

    /**
     * get the student's second name
     * @return string
     */
    public function getStudentSurname()
    {
        return $this->studentSurname;
    }

    /**
     * get the project's id
     * @return int
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * get the student's email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * get the member's id
     * @return integer
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * get the image name
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    //*********************************************
    //****************** SETTERS ******************
    //*********************************************
    /**
     * set the student's id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * set the student's first name
     * @param $studentName
     */
    public function setStudentName($studentName)
    {
        $this->studentName = $studentName;
    }

    /**
     * set the student's second name
     * @param $studentSurname
     */
    public function setStudentSurname($studentSurname)
    {
        $this->studentSurname = $studentSurname;
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
     * set the student's email
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * set the student's id
     * @param $memberId
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
    }

    /**
     * se the student's profile image name
     * @param $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    //*********************************************
    //********** ADDITIONAL FUNCTIONS *************
    //*********************************************
    /**
     * Get the Student details by her/his username
     * @param $username
     * @return mixed|null
     */
    public static function getStudentByUsername($username)
    {
        // Connect to Database
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM students WHERE studentName=:username';
        $statement = $connection->prepare($sql);

        // Bind parameters
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);

        // Execute the query
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }
}
