<?php

namespace Security_Utilities\Token_Utilities\interfaces;

interface IKTokenProvider
{

    public function createCode($code);
    public function getTokenFromRequest();
}

?>