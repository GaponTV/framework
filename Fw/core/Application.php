<?php
namespace Fw\Core;
require_once __DIR__ . "/pattern/Singltone.php";
require_once __DIR__ . "/Config.php";
require_once __DIR__ . "/Page.php";

final class Application
{
    use pattern\Singltone;

    private $__components = [];
    private $pager = null;
    private $template;

    private function __construct()
    {
        $config = Config::getInstance();
        $this->pager = Page::getInstance();
        $this->template = __DIR__ . "/../templates/". $config->get("template/id");
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
        $this->restartBuffer();
        $replaces = $this->pager->getAllReplace();
        echo str_replace(array_keys($replaces), array_values($replaces), $buffer);
        ob_end_flush();
    }

    private function restartBuffer()
    {
        ob_clean();
    }
}