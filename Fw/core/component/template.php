<?php
namespace Fw\Core\Component;
use Fw\Core\Page as Page;

class Template
{
    private string $__path;
    private string $__relativePath;
    private string $id;

    public function __construct($id, $path, $componentId)
    {
        $this->id = $id;
        $this->__path = $path . "/templates/" . $id . "/";
        $this->__relativePath = "components/" . str_replace(":", "/", $componentId) . "/templates/"
            . $id . "/";
    }

    public function render($params, $result, string $page = "template")
    {
        $pager = Page::getInstance();

        if(file_exists($this->__path . "result_modifier.php")){
            include $this->__path . "result_modifier.php";
        }

        if(file_exists($this->__path . $page . ".php")){
            include $this->__path.$page . ".php";
        }

        if(file_exists($this->__path . "component_epilog.php")){
            include $this->__path . "component_epilog.php";
        }

        if(file_exists($this->__path . "style.css")){
            $pager->addCss($this->__relativePath . "style.css");
        }

        if(file_exists($this->__path . "script.js")){
            $pager->addJs($this->__relativePath . "script.js");
        }
    }
}