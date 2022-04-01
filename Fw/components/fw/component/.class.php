<?php

namespace Fw\Components\fw;

use Fw\Core\Component\Base;

class Component extends Base
{
    public function __construct($id, $templateId, $params)
    {
        $this->__path = __DIR__;
        $this->params = $params;
        parent::__construct($id, $templateId);
    }

    public function executeComponent()
    {
        $this->result["message"] = "message: " . $this->params["message"];
        $this->template->render($this->params, $this->result);
    }
}