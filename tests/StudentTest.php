<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace ItbTest;

use Itb\Model\Student;

/**
 * Class StudentTest - it manages all the Student tests
 * @package ItbTest
 */
class StudentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the Student id is not different from expected result
     */
    public function testSetGetStudentIdTheSameValue()
    {
        // Arrange
        $student = new Student();
        $id = 5;
        $student->setId($id);
        $expectedResult = $id;

        // Act
        $result = $student->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test if the Student id is different from expected result
     */
    public function testSetGetStudentIdDifferentValues()
    {
        // Arrange
        $student = new Student();
        $id = 6;
        $student->setId($id);
        $notExpectedResult = 8;

        // Act
        $result = $student->getId();

        // Assert
        $this->assertNotEquals($notExpectedResult, $result);
    }

    /**
     * Test if the Student id is an integer
     */
    public function testSetStudentIdIsInteger()
    {
        // Arrange
        $student = new Student();
        $id = 9;
        $student->setId($id);

        // Act
        $result = $student->getId();

        // Assert
        $this->assertTrue(is_int($result));
    }

    /**
     * Test if the Student id is not null
     */
    public function testSetStudentIdToIntegerCheckIsNotNull()
    {
        // Arrange
        $student = new Student();
        $id = 13;
        $student->setId($id);

        // Act
        $result = $student->getId();

        // Assert
        $this->assertNotNull($result);
    }

    /**
     * Test if the Student name is a string value
     */
    public function testSetStudentNameIsString()
    {
        // Arrange
        $student = new Student();
        $student->setStudentName("John");

        // Act
        $result = $student->getStudentName();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * Test if the Student surname is a string value
     */
    public function testSetStudentSurnameIsString()
    {
        // Arrange
        $student = new Student();
        $student->setStudentSurname("Needle");

        // Act
        $result = $student->getStudentSurname();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * @dataProvider getSetProjectIdProvider
     * @param $valueSet - set the value
     * @param $expectedResult - expected value
     */
    public function testSetProjectIdDifferentValuesFromDataProvider($valueSet, $expectedResult)
    {
        // Arrange
        $student = new Student();
        $student->setProjectId($valueSet);

        // Act
        $result = $student->getProjectId();

        // Arrange
        $this->assertNotEquals($expectedResult, $result);
    }

    /**
     * Value 1 - set value
     * Value 2 - value expected
     * @return array
     */
    public function getSetProjectIdProvider()
    {
        return array(
            array(1, 2),
            array(3, 7),
            array(5, 6),
            array(9, 1),
            array(4, 8),
        );
    }

    /**
     * Test if the Student class contains a 'memberId' attribute
     */
    public function testClassHasAttributeMemberId()
    {
        // Arrange
        $student = new Student();

        // Act
        $attribute = 'memberId';
        $className = get_class($student);

        // Assert
        $this->assertClassHasAttribute($attribute, $className);
    }

    /**
     * Test if the Member id is not null
     */
    public function testSetMemberIdToIntCheckIsNotNull()
    {
        // Arrange
        $student = new Student();
        $id = 5;
        $student->setMemberId($id);

        // Act
        $result = $student->getMemberId();

        // Assert
        $this->assertNotNull($result);
    }

    /**
     * Test if the Student email contains the @ sign
     */
    public function testSetEmailContainsAtSign()
    {
        // Arrange
        $student = new Student();
        $student->setEmail("student@gmail.com");
        $atSign = '@';

        // Act
        $result = $student->getEmail();

        // Assert
        $this->assertContains($atSign, $result);
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

    /**
     * Test the Student's profile image name
     */
    public function testSetGetStudentProfileImageName()
    {
        // Arrange
        $student = new Student();
        $imageName = 'image.jpg';
        $student->setImageName($imageName);

        // Act
        $result = $student->getImageName();
        $expectedResult = 'image.jpg';

        // Arrange
        $this->assertEquals($expectedResult, $result);
    }
}
