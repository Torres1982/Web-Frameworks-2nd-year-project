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
}
