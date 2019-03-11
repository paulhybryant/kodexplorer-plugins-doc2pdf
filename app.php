<?php
class doc2pdfPlugin extends PluginBase{
    function __construct(){
        parent::__construct();
    }
    public function regiest(){
        $this->hookRegiest(array(
            'user.commonJs.insert' => 'doc2pdfPlugin.echoJs',
        ));
    }
    public function echoJs($st,$act){
        if($this->isFileExtence($st,$act)){
            $this->echoFile('static/main.js');
        }
    }
    public function doc2pdf(){
      $path = urldecode(_DIR($this->in['path']));
      $result = shell_exec("cd " . dirname($path) . " && soffice --headless --convert-to pdf " . $path . " --outdir " . dirname($path));
      echo "<script>console.log( 'Run: " . "soffice --headless --convert-to pdf " . $path . " --outdir " . dirname($path) . "' );</script>";
      echo "<script>console.log( 'Result: " . $result . "' );</script>";
    }
}
