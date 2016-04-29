<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace ItbTest;

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
}
