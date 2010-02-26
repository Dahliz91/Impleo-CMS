<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-23::14.05
     * @version			v1.0 2010-02-24::22.59
     */

class Impleo_ControllerAction extends Zend_Controller_Action {
    public $view;
    public $user;

    /**
     * The init function
     */
    public function init() {
        $this->view->system->version = Version::getVersion();
        $this->view->system->versionID = Version::getVersionID();
    }
}