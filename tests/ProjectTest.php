<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace ItbTest;

use Itb\Model\Project;

/**
 * Class ProjectTest - it manages all the Project tests
 * @package ItbTest
 */
class ProjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if the Project id is not different from expected result
     */
    public function testSetGetProjectIdTheSameValue()
    {
        // Arrange
        $project = new Project();
        $project->setId(7);
        $expectedResult = 7;

        // Act
        $result = $project->getId();

        // Assert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Test if the Project id is different from expected result
     */
    public function testSetGetProjectIdDifferentValues()
    {
        // Arrange
        $project = new Project();
        $project->setId(4);
        $notExpectedResult = 2;

        // Act
        $result = $project->getId();

        // Assert
        $this->assertNotEquals($notExpectedResult, $result);
    }

    /**
     * Test if the Project id is an integer
     */
    public function testSetProjectIdIsInteger()
    {
        // Arrange
        $project = new Project();
        $project->setId(9);

        // Act
        $result = $project->getId();

        // Assert
        $this->assertTrue(is_int($result));
    }

    /**
     * Test if the Project id is not null
     */
    public function testSetProjectIdToIntegerCheckIsNotNull()
    {
        // Arrange
        $project = new Project();
        $project->setId(4);

        // Act
        $result = $project->getId();

        // Assert
        $this->assertNotNull($result);
    }

    /**
     * Test if the Project name is a string value
     */
    public function testSetProjectNameIsString()
    {
        // Arrange
        $project = new Project();
        $project->setProjectName("Graphics");

        // Act
        $result = $project->getProjectName();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * Test if the Project title is a string value
     */
    public function testSetProjectTitleIsString()
    {
        // Arrange
        $project = new Project();
        $project->setProjectTitle("3D Gaming");

        // Act
        $result = $project->getProjectTitle();

        // Assert
        $this->assertTrue(is_string($result));
    }

    /**
     * Test if the Project class contains a 'projectStatus' attribute
     */
    public function testClassHasAttributeProjectStatus()
    {
        // Arrange
        $project = new Project();

        // Act
        //$status = get_object_vars($member);
        $attribute = 'projectStatus';
        $className = get_class($project);

        // Assert
        $this->assertClassHasAttribute($attribute, $className);
    }

    /**
     * Test if the Project status is not null
     */
    public function testSetProjectStatusToStringCheckIsNotNull()
    {
        // Arrange
        $project = new Project();
        $project->setProjectStatus("current");

        // Act
        $result = $project->getProjectStatus();

        // Assert
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider getSetProjectSupervisorIdProvider
     * @param $valueSet - set the value
     * @param $expectedResult - expected value
     */
    public function testSetProjectSupervisorIdTheSameValuesFromDataProvider($valueSet, $expectedResult)
    {
        // Arrange
        $project = new Project();
        $project->setProjectSupervisor($valueSet);

        // Act
        $result = $project->getProjectSupervisor();

        // Arrange
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Value 1 - set value
     * Value 2 - value expected
     * @return array
     */
    public function getSetProjectSupervisorIdProvider()
    {
        return array(
            array(2, 2),
            array(3, 3),
            array(6, 6),
            array(9, 9),
        );
    }
}
