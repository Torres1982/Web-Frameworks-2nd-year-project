<?php
/**
 * Created by B00073668
 * @author - Artur Sukiennik
 * @since - 2016
 */
namespace Itb\Model;

use Mattsmithdev\PdoCrud\DatabaseTable;

/**
 * Class Publication - manages the published projects
 * @package Itb
 */
class Publication extends DatabaseTable
{
    //*********************************************
    //**************** VARIABLES ******************
    //*********************************************
    /**
     * id of published project
     * @var integer
     */
    private $id;

    /**
     * title of the published project
     * @var string
     */
    private $title;

    /**
     * id of the author of the published project
     * @var string
     */
    private $authorId;

    /**
     * url of the published project
     * @var string
     */
    private $url;

    /**
     * Date of the published project
     * @var string
     */
    private $datePublished;

    //*********************************************
    //****************** GETTERS ******************
    //*********************************************
    /**
     * Get the publication id
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the name of the publication project
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the author's id
     * @return string
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Get the URL of published project
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the date of published project
     * @return string
     */
    public function getDatePublished()
    {
        return $this->datePublished;
    }

    //*********************************************
    //****************** SETTERS ******************
    //*********************************************
    /**
     * Set the id of the publication
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set the title of the publication
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set the author's id
     * @param $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * Set the URL of the published project
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Set the date of the published project
     * @param $datePublished
     */
    public function setDatePublished($datePublished)
    {
        $this->datePublished = $datePublished;
    }
}
