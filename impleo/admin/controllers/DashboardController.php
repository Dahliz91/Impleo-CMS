<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-03-05::15.38
     * @version			v1.0 2010-03-05::15.38
     */

class Admin_DashboardController extends Impleo_ControllerAdmin {
    /**
     * The init function
     */
    public function init() {
        parent::init();
    }

    /*
     * The default action
     */
    public function indexAction() {
        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('default')
               ->setLayoutPath(APP_PATH . '/admin/templates/' . $this->config->general->admintemplate . '/');
    }
}