<?php

namespace Project\Services;

class HtmlHelper
{
    public static function isRadioButtonChecked($query, string $buttonValue){
        return (isset($query['sort']) && $query['sort'] === $buttonValue) ? 'checked' : '';
    }

}