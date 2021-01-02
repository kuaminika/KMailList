<?php

namespace Security_Utilities\Token_Utilities\interfaces;

interface IkTokenValidator
{
    public function confirmIfTokenActuallyExists();
    public function validate();
    public function resolveCode($code);
}

?>