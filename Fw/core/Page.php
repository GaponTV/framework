<?php
namespace Fw\Core;

require_once __DIR__ . "/pattern/Singltone.php";
class Page
{
    use pattern\Singltone;

    private $styles = [];
    private $scripts = [];
    private $string = [];

    private $property = [];

    private function __construct()
    {
        $this->string = array('#FW_PAGE_STR#'  => array());
        $this->styles = array('#FW_PAGE_CSS#'  => array());
        $this->scripts = array('#FW_PAGE_JS#'  => array());
    }

    public function addJs(string $src)
    {
        $this->scripts['#FW_PAGE_JS#'][] = '<script src="' . $src . '"></script>';
        array_unique($this->scripts);
    }

    public function addCss(string $link)
    {
        $link = '<link rel="stylesheet" href="' . $link . '">';
        $this->styles['#FW_PAGE_CSS#'][] = $link;
        array_unique($this->styles['#FW_PAGE_CSS#']);
    }

    public function addString(string $str)
    {
        $this->string['#FW_PAGE_STR#'][] = $str;
    }

    public function setProperty(string $id, mixed $value)
    {
        $this->property[$this->showProperty($id)] = $value;
    }

    public function getProperty($id)
    {
        return $this->property[$this->showProperty($id)];
    }

    public function showProperty($id)
    {
        return '#FW_PAGE_PROPERTY_' . $id . '#';
    }

    public function getAllReplace()
    {
        $allReplace = array(
            '#FW_PAGE_JS#' => '',
            '#FW_PAGE_CSS#' => '',
            '#FW_PAGE_STR#' => ''
        );
        foreach ($this->scripts['#FW_PAGE_JS#'] as $script)
            $allReplace['#FW_PAGE_JS#'] .= $script;
        foreach ($this->styles['#FW_PAGE_CSS#'] as $style)
            $allReplace['#FW_PAGE_CSS#'] .= $style;
        foreach ($this->string['#FW_PAGE_STR#'] as $string)
            $allReplace['#FW_PAGE_STR#'] .= $string;

        return array_merge($allReplace, $this->property);
    }

    public function showHead()
    {
        echo "#FW_PAGE_JS#\n" . "#FW_PAGE_CSS#\n" . "#FW_PAGE_STR#\n" ;
    }
}