<?php 

namespace APISetUpTools;


abstract class ASetUpToolCommand
{

    public  $toolName = "SetUpTool";
    protected $tool;


    public function __construct(SetUpTool $tool)
    {

        $this->tool = $tool;
    }

    public abstract function execute();
}