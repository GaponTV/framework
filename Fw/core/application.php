<?php
namespace Fw\Core;

final class Application
{
    use pattern\Singltone;

    private $__components = [];
    private $pager = null;
    private $template;
    private $server;
    private $request;

    private function __construct()
    {
        $this->server = new Server();
        $this->request = new Request();
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

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getServer(): Server
    {
        return $this->server;
    }

    public function includeComponent(string $component, string $template, array $params)
    {
        if(!isset($this->__components[$component]))
        {
            $classes[] = get_declared_classes();
            $file = $_SERVER['DOCUMENT_ROOT'] . "/components/" .
                str_replace(":", "/", $component) . "/.class.php";
            require_once $file;
            $classes[] = get_declared_classes();
            $classes = array_diff($classes[1], $classes[0]);
            if(!empty($classes))
            {
                foreach ($classes as $class)
                {
                    if (is_subclass_of($class, 'FW\core\Component\Base'))
                    {
                        $this->__components[$component] = $class;
                        break;
                    }
                }
            }
        }
        $class = $this->__components[$component];
        $__component = new $class($component, $template, $params);
        $__component->executeComponent();
    }
}