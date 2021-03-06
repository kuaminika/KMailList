<?php

namespace models
{
    require_once dirname(__FILE__). "/interfaces/IMessage.php";
    require_once dirname(__FILE__). "/AModel.php";
    use models\interfaces\IMessage;
 class FormedOutMessage extends AModel implements IMessage 
 {     
 
    private $title;
    private $author; // string
    private $content;
    private $lastUpdateDate;
   

    public function __construct($raw)
    {     
  
          $this-> title= $this->getValueFromArg("title",$raw);//$raw["title"];
          $this-> author = $this->getValueFromArg("author",$raw);//  $raw["author"];
          $this-> content = $this->getValueFromArg("content",$raw);// $raw["content"];

          $this-> lastUpdateDate =\key_exists("lastUpdateDate",$raw)? $raw["lastUpdateDate"] : $this->getDateSent();
    }


      public function getDateSent()
      {
         return   new \DateTime();
      }

      /**
       * Get the value of lastUpdateDate
       */
      public function getLastUpdateDate()
      {
         return  $this->lastUpdateDate->format('Y-m-d\ H:i:s.u');;
      }

      /**
       * Set the value of lastUpdateDate
       *
       * @return  self
       */
      public function setLastUpdateDate($lastUpdateDate)
      {
         $this->lastUpdateDate = $lastUpdateDate;

         return $this;
      }

      /**
       * Get the value of author
       */
      public function getAuthor()
      {
         return $this->author;
      }

      /**
       * Set the value of author
       *
       * @return  self
       */
      public function setAuthor($author)
      {
         $this->author = $author;

         return $this;
      }

      /**
       * Get the value of content
       */
      public function getContent()
      {
         return $this->content;
      }

      /**
       * Set the value of content
       *
       * @return  self
       */
      public function setContent($content)
      {
         $this->content = $content;

         return $this;
      }



    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }


   }


 }
?>
