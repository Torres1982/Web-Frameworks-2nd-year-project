<?php
namespace ItbTest;

use Itb\Model\Student;

/**
 * Class StudentDbMethodsTest - it manages the 'getStudentByUsername' test
 * @package ItbTest
 */
class StudentDbMethodsTest extends \PHPUnit_Extensions_Database_TestCase
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
        $numRowsAtStart = 6;
        $expectedResult = $numRowsAtStart;

        // Act

        // Assert
        $this->assertEquals($expectedResult, $this->getConnection()->getRowCount('students'));
    }

    /**
     * Test get Student by username - existing username
     */
    public function testGetStudentByUsername()
    {
        // Arrange
        $student = new Student();
        $studentName = 'Brian';

        // Act
        $object = $student->getStudentByUsername($studentName);

        // Assert
        $this->assertNotNull($object);
        //$this->assertTrue(is_string($studentName));
    }

    /**
     * Test get Student by username - non existing username
     */
    public function testGetStudentByUsernameNonExistingUser()
    {
        // Arrange
        $student = new Student();
        $nonExistingUser = null;

        // Act
        $object = $student->getStudentByUsername($nonExistingUser);

        // Assert
        $this->assertNull($object);
    }
}
