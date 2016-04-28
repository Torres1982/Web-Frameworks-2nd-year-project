<?php
namespace ItbTest;

use Itb\Model\Login;

/**
 * Class LoginTest - it manages all the Login tests
 * @package ItbTest
 */
class LoginTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the Login user ID is not different than expected result
     */
    public function testSetGetLoginUserIdTheSameValue()
    {
        // Arrange
        $login = new Login();
        $login->setId(3);
        $expectedResult = 3;

        // Act
        $result = $login->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test if the Login username is a string value
     */
    public function testSetLoginUsernameIsString()
    {
        // Arrange
        $login = new Login();
        $username = 'Hammer';
        $login->setUsername($username);

        // Act
        $result = $login->getUsername();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * Test if the Login password is a string value
     */
    public function testSetLoginPasswordIsString()
    {
        // Arrange
        $login = new Login();
        $password = '34restaurantDub-23';
        $login->setPassword($password);

        // Act
        $result = $login->getPassword();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * Test if the Login class contains a 'role' attribute
     */
    public function testClassHasAttributeRole()
    {
        // Arrange
        $login = new Login();

        // Act
        $attribute = 'role';
        $className = get_class($login);

        // Assert
        $this->assertClassHasAttribute($attribute, $className);
    }

    /**
     * @dataProvider getSetLoginRoleProvider
     * @param $valueSet - set the value
     * @param $expectedResult - expected value
     */
    public function testSetLoginRoleTheSameValuesFromDataProvider($valueSet, $expectedResult)
    {
        // Arrange
        $login = new Login();
        $login->setRole($valueSet);

        // Act
        $result = $login->getRole();

        // Arrange
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Value 1 - set value
     * Value 2 - value expected
     * @return array
     */
    public function getSetLoginRoleProvider()
    {
        return array(
            array('current', 'current'),
            array('past', 'past'),
        );
    }

    /**
     * Test the get one Login user by username - non existing user
     */
    public function testGetLoginUserByUsernameNonExistingUser()
    {
        // Arrange
        $login = new Login();
        $username = null;

        // Act
        $object = $login->getOneByUsername($username);

        // Assert
        $this->assertNull($object);
    }

    /**
     * Test the matching the username with password
     */
    public function testMatchUsernameWithPassword()
    {
        // Arrange
        $login = new Login();
        $username = 'Artur';
        $password = 'Torres';
        $login->setPassword($password);
        $login->setUsername($username);

        // Act
        $matchedUserPass = $login->matchUserWithPassword('Artur', 'Torres');

        // Assert
        $this->assertTrue($matchedUserPass);
    }

    /**
     * Test the matching the username with invalid password
     */
/*
    public function testMatchUsernameWithInvalidPassword2()
    {
        // Arrange
        $login = new Login();
        $username = 'Artur';
        $password = 'Wrong';
        $login->setPassword($password);
        $login->setUsername($username);

        // Act
        $matchedUserInvalidPass = $login->matchUserWithPassword('Artur', 'Wrong');

        // Assert
        $this->assertFalse($matchedUserInvalidPass);
    }

        public function testMatchUsernameWithPasswordUserNull()
        {
            // Arrange
            $login = new Login();
            $login->setUsername('Artur');

            // Act
            $matchedUserInvalidPass = $login->matchUserWithPassword(null, 'Torres');

            // Arrange
            //$this->assertFalse($username == 'Artur');
            $this->assertFalse($matchedUserInvalidPass);
        }
    */
    /**
     * Test matching user with invalid password
     */
    public function testMatchUsernameWithInvalidPassword()
    {
        // Arrange
        $login = new Login();

        // Act
        $result = $login->matchUserWithPassword('Artur', '');

        // Assert
        $this->assertFalse($result);
    }

    public function testSetPasswordCompareToHashedPassword()
    {
        // Arrange
        $login = new Login();
        $password = 'password';
        $expectedResult = $password;
        $login->setPassword($expectedResult);

        // Act
        $result = $login->getPassword();
        $passwordVerified = password_verify('password', $result);

        // Assert
        $this->assertTrue($passwordVerified);
    }

    /**
     * Test matching the username with her/his role
     */
    public function testMatchUserWithRole()
    {
        // Arrange
        $login = new Login();

        // Act
        $matchedUserRole = $login->matchUserWithRole('Artur');

        // Assert
        $this->assertTrue($matchedUserRole == true);
    }

    /**
     * Test matching the username with invalid username
     */
    public function testMatchUserWithInvalidUserRole()
    {
        // Arrange
        $login = new Login();

        // Act
        $result = $login->matchUserWithRole('');

        // Assert
        $this->assertFalse($result);
    }

    /**
     * Test the appending the user login, password and role to the file
     */
    public function testAppendUserLoginToFile()
    {
        // Arrange
        $login = new Login();
        $role = 'admin';
        $username = 'Artur';
        $password = 'Torres';

        // Act
        $userAppendedToFile = $login->appendUserLoginToFile($role, $username, $password);

        // Assert
        $this->assertTrue(is_null($userAppendedToFile));
    }
}
