<?php
namespace Mail_utilities;

require_once dirname(__FILE__)."/IKMailTemplate.php";


interface IKMailMessage
{
    public function getPurpose();
    public function textPart();
    public function getSender();
   public function getSubject();
   public function getContent();
   public function setTemplate(IKMailTemplate $template);
  
}


?>