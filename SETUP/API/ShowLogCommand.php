<?php 

namespace APISetUpTools;


class ShowLogCommand extends ASetUpToolCommand
{  

    private $logRepoTool;
    private $dbTool;

    public function __construct(SetUpTool $tool)
    {
        $this->tool = $tool;        
        $this->logRepoTool = new LogRepository($this->tool);        
    }

    public function execute()
    {
       $logArray =  $this->logRepoTool->getAllLogs();

        echo json_encode($logArray);
    }
}