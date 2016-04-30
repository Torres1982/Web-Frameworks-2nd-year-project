<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace Itb\model;

use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;

/**
 * Class Login - manages the login for students and members
 * @package Itb
 */
class Login extends DatabaseTable
{
    //*********************************************
    //**************** VARIABLES ******************
    //*********************************************

    /**
     * auto-increment id
     * @var int
     */
    private $id;

    /**
     * username used as a login
     * @var string
     */
    private $username;

    /**
     * password used to log in
     * @var string
     */
    private $password;

    /**
     * role used to redirect users to different pages
     * @var string
     */
    private $role;

    //*********************************************
    //****************** GETTERS ******************
    //*********************************************
    /**
     * Get the id for the user
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the username used to log in
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the password to log in
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the role of each user
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    //*********************************************
    //****************** SETTERS ******************
    //*********************************************
    /**
     * Set the ID
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set the username
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set the hashed password
     * @param $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $this->password = $hashedPassword;
    }

    /**
     * Set the role for each student
     * @param $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    //*********************************************
    //********** ADDITIONAL FUNCTIONS *************
    //*********************************************
    /**
     * Get the user by his username
     * @param $username
     * @return object
     */
    public static function getOneByUsername($username)
    {
        // Connect to Database
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM logins WHERE username=:username';
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

    /**
     * Match username and her/his role
     * @param $username
     * @return bool
     */
    public static function matchUserWithRole($username)
    {
        $user = Login::getOneByUsername($username);

        //If user is not found in the Database, return false
        if (null == $user) {
            return false;
        } else {
            //If user is found in the Database, return user role
            return $user->getRole();
        }
    }

    /**
     * Append each new Login User to the 'logins.txt' file
     * @param $role
     * @param $name
     * @param $password
     * @return bool
     */
    public function appendUserLoginToFile($role, $name, $password)
    {
        $this->role = $role;
        $this->username = $name;
        $this->password = $password;

        // Set the string to lower case for the user 'role'
        $role = strtolower($role);

        // Set the first letter uppercase for the 'username'
        //$name = ucwords($name);

        // Create the new file if does not exist
        $loginDetailsFile = '../logins.txt';

        // File Handler - opens a file and allows to append to the file
        $fileHandler = fopen($loginDetailsFile, 'a') or die('File ' . $loginDetailsFile . ' not found!');

        // Add text to the file
        $stringLogin = 'Username: ' . $name . ' / Password: ' . $password . ' / (' . $role . ')' .  PHP_EOL;

        // Write strings to the file
        fwrite($fileHandler, $stringLogin);

        // Close the file
        fclose($fileHandler);

        //echo 'New login appended to the ' . $loginDetailsFile . ' file';
        return true;
    }
}
