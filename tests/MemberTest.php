<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace ItbTest;

use Itb\Model\Member;

/**
 * Class MemberTest - it manages all the Member tests
 * @package ItbTest
 */
class MemberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the Member id is not different from expected result
     */
    public function testSetGetMemberIdTheSameValue()
    {
        // Arrange
        $member = new Member();
        $member->setId(3);
        $expectedResult = 3;

        // Act
        $result = $member->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test if the Member id is different from expected result
     */
    public function testSetGetMemberIdDifferentValues()
    {
        // Arrange
        $member = new Member();
        $member->setId(3);
        $notExpectedResult = 8;

        // Act
        $result = $member->getId();

        // Assert
        $this->assertNotEquals($notExpectedResult, $result);
    }

    /**
     * Test if the Member id is an integer
     */
    public function testSetMemberIdIsInteger()
    {
        // Arrange
        $member = new Member();
        $member->setId(6);

        // Act
        $result = $member->getId();

        // Assert
        $this->assertTrue(is_int($result));
    }

    /**
     * Test if the Member id is not null
     */
    public function testSetMemberIdToIntegerCheckIsNotNull()
    {
        // Arrange
        $member = new Member();
        $member->setId(4);

        // Act
        $result = $member->getId();

        // Assert
        $this->assertNotNull($result);
    }

    /**
     * Test if the Member name is a string value
     */
    public function testSetMemberNameIsString()
    {
        // Arrange
        $member = new Member();
        $member->setMemberName("Kate");

        // Act
        $result = $member->getMemberName();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * Test if the Member surname is a string value
     */
    public function testSetMemberSurnameIsString()
    {
        // Arrange
        $member = new Member();
        $member->setMemberSurname("Clark");

        // Act
        $result = $member->getMemberSurname();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * Test if the Member email contains the @ sign
     */
    public function testSetEmailContainsAtSign()
    {
        // Arrange
        $member = new Member();
        $member->setEmail("example@gmail.com");
        $atSign = '@';

        // Act
        $result = $member->getEmail();

        // Assert
        $this->assertContains($atSign, $result);
    }

    /**
     * Test if the Member class contains a 'memberStatus' attribute
     */
    public function testClassHasAttributeMemberStatus()
    {
        // Arrange
        $member = new Member();

        // Act
        //$status = get_object_vars($member);
        $attribute = 'memberStatus';
        $className = get_class($member);

        // Assert
        $this->assertClassHasAttribute($attribute, $className);
    }

    /**
     * Test if the Member status is not null
     */
    public function testSetMemberStatusToStringCheckIsNotNull()
    {
        // Arrange
        $member = new Member();
        $member->setMemberStatus("past");

        // Act
        $result = $member->getMemberStatus();

        // Assert
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider getSetProjectIdProvider
     * @param $valueSet - set the value
     * @param $expectedResult - expected value
     */
    public function testSetProjectIdTheSameValuesFromDataProvider($valueSet, $expectedResult)
    {
        // Arrange
        $member = new Member();
        $member->setProjectId($valueSet);

        // Act
        $result = $member->getProjectId();

        // Arrange
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Value 1 - set value
     * Value 2 - value expected
     * @return array
     */
    public function getSetProjectIdProvider()
    {
        return array(
            array(2, 2),
            array(3, 3),
            array(6, 6),
            array(9, 9),
            array(14, 14),
        );
    }
}
