<?php

namespace Returnnull;

class AdminLoginProjector
{
    public function getHtml()
    {
        return $this->fillContent();
    }

    private function fillContent()
    {
        $html   = file_get_contents(HTML . 'adminLoginTemplate.html');
        $header = file_get_contents(HTML . '_header.html');
        $head   = file_get_contents(HTML . '_head.html');

        $html   = str_replace('%HEAD%',   $head,   $html);
        $html   = str_replace('%HEADER%', $header, $html);

        return $html;
    }
}