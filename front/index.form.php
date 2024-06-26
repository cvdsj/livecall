<?php

/**
 * -------------------------------------------------------------------------
 * LiveCall a Chat Plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation files
 * (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge,
 * publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 * 
 * -------------------------------------------------------------------------
 * @copyright Copyright (C) 2023 by Rafael Antonio (r4phf43l).
 * @license   MIT https://opensource.org/licenses/MIT
 * @link      https://github.com/r4phf43l/livecall
 * -------------------------------------------------------------------------
 */

include ("../../../inc/includes.php");

$plugin = new Plugin();
if (!$plugin->isInstalled('livecall') || !$plugin->isActivated('livecall')) {
   Html::displayNotFoundError();
}

$object = new PluginLivecallSets();

if (isset($_POST['update'])) {
   $object->can($_POST['id'], UPDATE);
   $object->update($_POST);
   // Generate or update livecall.js
   $file = 'livecall.js';
   // $path = $_SERVER['DOCUMENT_ROOT'] . '/' . Plugin::getWebDir('livecall', false) . '/';
   $path = GLPI_ROOT . '/' . Plugin::getWebDir('livecall', false) . '/';
   $string = $_POST['javascript'];
   $string = str_replace('\r', '', $string);
   $string = str_replace('\n', '', $string);
   $string = str_replace('\t', '', $string);
   $string = str_replace('\'', '"', $string);
   $string = str_replace('\"', '"', $string);
   file_put_contents($path . $file, $string);
   // End
   Html::back();
}
