<?php

/**
 * Description of ErrorBox
 *
 * @author Pedro Giacometto
 */
class Zend_View_Helper_ErrorBox extends Zend_View_Helper_Abstract
{

    public function errorBox($msg)
    {
        return "<div class = 'error'>$msg</div>";
    }

}

