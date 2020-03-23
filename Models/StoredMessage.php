<?php

namespace models;

    require_once "interfaces/IMessage.php";
    require_once "AModel.php";

    use models\interfaces\IMessage;
 class StoredMessage extends AModel implements IMessage
 {
     
    private $id; 
    private $authorId;
    private $authorName;
    private $authorEmail;
    private $title;
    private $content;
    private $lastUpdateDate;
    private $dateSent;
    private $listId;

    public function __construct($raw)
    {           
          $this->id = $raw["message_id"];
          $this->authorId = $raw["author_id"];
          $this->authorName = $raw["author_name"];
          $this->authorEmail = $raw["author_email"];
          $this-> title= $raw["title"];
          $this-> content = $raw["content"];
          $this-> lastUpdateDate = $raw["last_update_date"];
          $this->dateSent = $raw["sent_date"];
          $this->listId =$raw["list_id"];   
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

      /**
       * Get the value of id
       */
      public function getId()
      {
         return $this->id;
      }

      /**
       * Set the value of id
       *
       * @return  self
       */
      public function setId($id)
      {
         $this->id = $id;

         return $this;
      }

      /**
       * Get the value of listId
       */
      public function getListId()
      {
         return $this->listId;
      }

      /**
       * Set the value of listId
       *
       * @return  self
       */
      public function setListId($listId)
      {
         $this->listId = $listId;

         return $this;
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
     * Get the value of dateSent
     */ 
    public function getDateSent()
    {
        return $this->dateSent;
    }

    /**
     * Set the value of dateSent
     *
     * @return  self
     */ 
    public function setDateSent($dateSent)
    {
        $this->dateSent = $dateSent;

        return $this;
    }



    
    /**
     * Get the value of authorId
     */ 
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set the value of authorId
     *
     * @return  self
     */ 
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }


    /**
     * Get the value of authorName
     */ 
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set the value of authorName
     *
     * @return  self
     */ 
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * Get the value of authorEmail
     */ 
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Set the value of authorEmail
     *
     * @return  self
     */ 
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;

        return $this;
    }
   }


?>
