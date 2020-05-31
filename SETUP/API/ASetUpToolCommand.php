<?php 

namespace APISetUpTools;


abstract class ASetUpToolCommand
{

    protected $tool;


    public function __construct(SetUpTool $tool)
    {

        $this->tool = $tool;
    }

    public abstract function execute();
}