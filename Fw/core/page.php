<?php
namespace Fw\Core;

class Page
{
    use pattern\Singltone;

    private const MACROS = [
        'JS' => '#FW_PAGE_STR#',
        'CSS' => '#FW_PAGE_CSS#',
        'STR' => '#FW_PAGE_JS#'
    ];
    private $styles = [];
    private $scripts = [];
    private $strings = [];

    private $property = [];

    private function __construct() { }

    public function addJs(string $src)
    {
        foreach ($this->scripts as $script)
        {
            if (md5($src) === md5($script)) return;
        }
        $this->scripts[] = $src;
    }

    public function getJs()
    {
        $scripts = [];
        foreach ($this->scripts as $script)
        {
            $scripts[] = '<script src="' . $script . '"></script>';
        }
        return $scripts;
    }

    public function addCss(string $link)
    {
        foreach ($this->styles as $style)
        {
            if (md5($link) === md5($style)) return;
        }
        $this->styles[] = $link;
    }

    public function getCss()
    {
        $styles = [];
        foreach ($this->styles as $style)
        {
            $styles[] = '<link rel="stylesheet" href="' . $style . '">';
        }
        return $styles;
    }

    public function addString(string $str)
    {
        $this->strings[] = $str;
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

        $allReplace = [
            self::MACROS['JS'] => implode("\n", $this->getJs()),
            self::MACROS['CSS'] => implode("\n", $this->getCss()),
            self::MACROS['STR'] => implode("\n", $this->strings)
        ];
        return array_merge($allReplace, $this->property);
    }

    public function showHead()
    {
        echo implode(array_values(self::MACROS));
    }
}