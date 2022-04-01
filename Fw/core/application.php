<?php
namespace Fw\Core;

final class Application
{
    use pattern\Singltone;

    private $__components = [];
    private $pager = null;
    private $template;

    private function __construct()
    {
        $this->pager = Page::getInstance();
        $this->template = $_SERVER['DOCUMENT_ROOT'] . "/templates/" . Config::get("template/id");
    }

    public function header()
    {
        $this->startBuffer();
        require  $this->template . "/header.php";
    }
    public function footer()
    {
        require $this->template . "/footer.php";
        $this->endBuffer();
    }

    private function startBuffer()
    {
        ob_start();
    }

    private function endBuffer()
    {
        $buffer = ob_get_contents();
        ob_end_clean();
        $replaces = $this->pager->getAllReplace();
        echo str_replace(array_keys($replaces), array_values($replaces), $buffer);
    }

    private function restartBuffer()
    {
        ob_clean();
    }
}