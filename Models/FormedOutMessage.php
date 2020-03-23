<?php

namespace models
{
    require_once dirname(__FILE__). "/interfaces/IMessage.php";
    require_once dirname(__FILE__). "/AModel.php";
    use models\interfaces\IMessage;
 class FormedOutMessage extends AModel implements IMessage 
 {     
 
    private $title;
    private $author;
    private $content;
    private $lastUpdateDate;
   

    public function __construct($raw)
    {     
  
          $this-> title= $raw["title"];
          $this-> author =  $raw["author"];
          $this-> content = $raw["content"];
          $this-> lastUpdateDate = $raw["lastUpdateDate"];
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
         return $this->lastUpdateDate;
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
