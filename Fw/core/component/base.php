<?php
namespace Fw\Core\Component;

abstract class Base
{
    public array $result;
    public string $id;
    public array $params;
    public $template;
    public $__path;


    public function __construct($id, $templateId)
    {
        $this->id = $id;
        $this->template = new Template($templateId, $this->__path, $this->id);
    }

    public abstract function executeComponent();
}