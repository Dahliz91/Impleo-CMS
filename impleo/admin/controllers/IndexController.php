<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-23::22.06
     * @version			v1.0 2010-03-11::22.18
     */

class Admin_IndexController extends Impleo_ControllerAdmin {
    /**
     * The init function
     */
    public function init() {
        parent::init();
        $this->_redirect( $this->config->system->url . '/admin/dashboard', array(), $message );
    }

    /*
     * The default action
     */
    public function indexAction() {

    }
}