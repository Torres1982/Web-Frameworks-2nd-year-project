<?php
namespace ItbTest;

use Itb\Model\Login;

/**
 * Class LoginDbMethodsTest - it manages the Login tests
 * @package ItbTest
 */
class LoginDbMethodsTest extends \PHPUnit_Extensions_Database_TestCase
{
    /**
     * Get connection to database
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    public function getConnection()
    {
        $host = DB_HOST;
        $dbName = DB_NAME;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;

        // Mysql
        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbName;
        $db = new \PDO($dsn, $dbUser, $dbPass);

        $connection = $this->createDefaultDBConnection($db, $dbName);

        return $connection;
    }

    /**
     * Create the data set from the seed file
     * @return \PHPUnit_Extensions_Database_DataSet_XmlDataSet
     */
    public function getDataSet()
    {
        $seedFilePath = __DIR__ . '/xml/students.xml';

        return $this->createXMLDataSet($seedFilePath);
    }

    /**
     * Test the number of rows from seed data file
     */
    public function testNumRowsFromSeedData()
    {
        // Arrange
        $numRowsAtBeginning = 3;
        $expectedResult = $numRowsAtBeginning;

        // Act

        // Assert
        $this->assertEquals($expectedResult, $this->getConnection()->getRowCount('logins'));
    }

    /**
     * Test the get one Login user by username - non existing user
     */
    public function testGetLoginUserByUsernameNonExistingUser()
    {
        // Arrange
        $user = null;

        // Act
        $object = Login::getOneByUsername($user);

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
        $role = 'admin';
        $login->setRole($role);

        // Act
        $userRole = $login->getRole();
        $matchedUserPass = $login->matchUserWithPassword('Artur', 'Torres');

        // Assert
        $this->assertTrue($matchedUserPass);
        $this->assertNotNull($userRole);
    }

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

    /**
     * Test matching the username with her/his role
     */
    public function testMatchUserWithRole()
    {
        // Arrange
        $login = new Login();
        $role = 'admin';

        // Act
        $matchedUserRole = $login->matchUserWithRole($role);

        // Assert
        $this->assertFalse($matchedUserRole);
        $this->assertSame('admin', $role);
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
