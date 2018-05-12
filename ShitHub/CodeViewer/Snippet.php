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
    
}