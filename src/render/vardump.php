<?php
/**
 * JBDump
 *
 * Copyright (c) 2015, Denis Smetannikov <denis@jbzoo.com>.
 *
 * @package   JBDump
 * @author    Denis Smetannikov <denis@jbzoo.com>
 * @copyright 2015 Denis Smetannikov <denis@jbzoo.com>
 * @link      http://github.com/smetdenis/jbdump
 */

namespace SmetDenis\JBDump;

/**
 * Class RenderVarDump
 * @package SmetDenis\JBDump
 */
class RenderVarDump
{
    /**
     * Wrapper for PHP var_dump function
     * @param   mixed  $var     The variable to dump
     * @param   string $varname Echo output if true
     * @param   array  $params  Additionls params
     * @return bool|JBDump
     */
    public static function var_dump($var, $varname = '...', $params = array())
    {
        if (!self::isDebug()) {
            return false;
        }

        // var_dump the variable into a buffer and keep the output
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        $_this  = self::i();

        // neaten the newlines and indents
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        //if (!extension_loaded('xdebug')) {
        $output = $_this->_htmlChars($output);
        //}

        $_this->_dumpRenderHtml($output, $varname . '::html', $params);

        return $_this;
    }





    /**
     * Dump render - php var_dump
     * @param mixed  $data
     * @param string $varname
     * @param array  $params
     */
    protected function _dumpRenderVardump($data, $varname = '...', $params = array())
    {
        $this->var_dump($data, $varname, $params);
    }

}