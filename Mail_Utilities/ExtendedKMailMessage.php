<?php
namespace Mail_utilities;
require_once dirname(__FILE__)."/KMailMessage.php";


class ExtendedKMailMessage extends KMailMessage
{


    public function __construct($raw,IKMailTemplate $template)
    {
        parent::__construct($raw,$template);

    }


}