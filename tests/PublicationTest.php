<?php
namespace ItbTest;

use Itb\Model\Publication;

/**
 * Class PublicationTest - it manages all the Publication tests
 * @package ItbTest
 */
class PublicationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the Publication id is not different from expected result
     */
    public function testSetGetPublicationIdTheSameValue()
    {
        // Arrange
        $publication = new Publication();
        $publication->setId(1);
        $expectedResult = 1;

        // Act
        $result = $publication->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test if the Publication id is different from expected result
     */
    public function testSetGetPublicationIdDifferentValues()
    {
        // Arrange
        $publication = new Publication();
        $publication->setId(3);
        $notExpectedResult = 4;

        // Act
        $result = $publication->getId();

        // Assert
        $this->assertNotEquals($notExpectedResult, $result);
    }

    /**
     * Test if the Publication id is an integer
     */
    public function testSetPublicationIdIsInteger()
    {
        // Arrange
        $publication = new Publication();
        $publication->setId(6);

        // Act
        $result = $publication->getId();

        // Assert
        $this->assertTrue(is_int($result));
    }

    /**
     * Test if the Publication id is not null
     */
    public function testSetPublicationIdToIntegerCheckIsNotNull()
    {
        // Arrange
        $publication = new Publication();
        $publication->setId(4);

        // Act
        $result = $publication->getId();

        // Assert
        $this->assertNotNull($result);
    }

    /**
     * Test if the Publication title is a string value
     */
    public function testSetPublicationTitleIsString()
    {
        // Arrange
        $publication = new Publication();
        $publication->setTitle("Graphics in Computing");

        // Act
        $result = $publication->getTitle();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * Test if the Author id is an integer
     */
    public function testSetAuthorIdIsInteger()
    {
        // Arrange
        $publication = new Publication();
        $publication->setAuthorId(2);

        // Act
        $result = $publication->getAuthorId();

        // Assert
        $this->assertTrue(is_int($result));
    }

    /**
     * Test if the Publication url is not null
     */
    public function testSetPublicationUrlToStringCheckIsNotNull()
    {
        // Arrange
        $publication = new Publication();
        $publication->setUrl("www.publication.com");

        // Act
        $result = $publication->getUrl();

        // Assert
        $this->assertNotNull($result);
    }

    /**
     * Test if the Publication url contains the 'www' string
     */
    public function testSetUrlContainsWwwString()
    {
        // Arrange
        $publication = new Publication();
        $publication->setUrl("www.publication.com");
        $urlPartString = 'www';

        // Act
        $result = $publication->getUrl();

        // Assert
        $this->assertContains($urlPartString, $result);
    }

    /**
     * Test if the Publication date is a valid date
     */
    public function testSetDateIsValidDate()
    {
        // Arrange
        $publication = new Publication();
        $datePublished = '31-12-2015';
        $publication->setDatePublished($datePublished);
        //(checkdate(12, 31, 2000));

        // Act
        $result = $publication->getDatePublished();
        $date = date($result);

        // Assert
        $this->assertSame($result, $date);
    }
}
