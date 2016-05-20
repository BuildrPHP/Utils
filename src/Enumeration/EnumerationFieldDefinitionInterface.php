<?php  namespace BuildR\Utils\Enumeration;

/**
 * Defines enumeration that can provide multiple fields for a key
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package Utils
 * @subpackage Enumeration
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://raw.githubusercontent.com/BuildrPHP/Utils/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Utils
 */
interface EnumerationFieldDefinitionInterface {

    public static function defineFields();

}
