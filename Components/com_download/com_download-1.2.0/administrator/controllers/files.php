<?php
/**
 * @version     1.2.0
 * @package     com_download
 * @copyright   Aviation Media (TM) Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Jose <jose@aviationmedia.aero> - http://www.aviationmedia.aero
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Files controller class.
 */
class DownloadControllerFiles extends JControllerForm
{

    function __construct() {
        $this->view_list = 'downloads';
        parent::__construct();
    }

}