<?php

namespace models{


require_once "AModel.php";
class ModelList
{
    private $innerArr;

    public function __construct()
    {
        $this->innerArr = [];
    }

    public function add(AModel $model)
    {
        $this->innerArr [] = $model;        
    }


    public function getContents()
    {
        return $this->innerArr;
    }

    public function _toJson()
    {
        $result="[";

        foreach($this->innerArr as $model)
        {
            $result .= $model->_toJson() .",";
        }
        
        $result = rtrim($result, ",");

        $result.="]";

        return $result;
    }


}



}

?>