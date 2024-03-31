<?php

namespace app\core\form;

class Form 
{

    public static function start($action, $method)
    {
        // Template voor begin form met sprint f, wat ervoor zorgt dat ik een action en method kan aangeven
        return sprintf('<form action="%s" method="%s">', $action, $method);
    }

    public static function end()
    {
        // Template voor einde form
        return '</form>';
    }

}