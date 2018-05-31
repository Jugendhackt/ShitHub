<?php
/**
 * Created by PhpStorm.
 * User: anghenfil
 * Date: 12.05.18
 * Time: 15:14
 */

namespace ShitHub\CodeViewer;


class Snippet{
    private $id;
    private $title;
    private $description;
    private $language;
    private $tags;
    private $author_id;
    private $author_name;
    private $status;
    private $date;
    private $filepath;

    public function __construct($id, $title, $description, $language, $tags, $author_id, $author_name, $status, $date){
        if (!empty($this)) {
            $this->id = $id;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }
        if (!empty($title)) {
            $this->title = $title;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }
        if (!empty($description)) {
            $this->description = $description;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }
        if (!empty($language)) {
            $this->language = $language;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }
        if (!empty($tags)) {
            $this->tags = $tags;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }
        if (!empty($author_id)) {
            $this->author_id = $author_id;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }
        if (!empty($author_name)) {
            $this->author_name = $author_name;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }
        if (!empty($status)) {
            $this->status = $status;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }
        if (!empty($date)) {
            $this->date = $date;
        }else{
            throw new \InvalidArgumentException("Parameter must be declared and not empty");
        }

        if(file_exists($_ENV['UPLOAD_DIR'].'/'.$id.'.snippet')){
            $this->filepath = $_ENV['UPLOAD_DIR'].'/'.$id.'.snippet';
        }else{
            throw new \InvalidPathException();
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * @param mixed $author_id
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->author_name;
    }

    /**
     * @param mixed $author_name
     */
    public function setAuthorName($author_name)
    {
        $this->author_name = $author_name;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getFilepath(): string
    {
        return $this->filepath;
    }

    /**
     * @param string $filepath
     */
    public function setFilepath(string $filepath)
    {
        $this->filepath = $filepath;
    }
    
}