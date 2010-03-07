<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-23::22.07
     * @version			v1.0 2010-03-05::15.33
     */

class Impleo_ControllerAdmin extends Impleo_ControllerAction {
    /**
     * The init function
     */
    public function init() {
        parent::init();

        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('login')
               ->setLayoutPath(APP_PATH . '/admin/templates/' . $this->config->general->admintemplate . '/');
    }
}