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
     * @version			v1.0 2010-03-07::21.07
     */

class Impleo_ControllerAction extends Zend_Controller_Action {
    public $view;
    public $user;

    /**
     * The init function
     */
    public function init() {
        $view = Zend_Layout::getMvcInstance()->getView();
        $this->view = $view;

        // Load version settings
	$oVersion = new Impleo_Version();
        $sVersion = $oVersion->getVersion();
        $this->view->system->version = $sVersion;
        $sVersionID = $oVersion->getVersionID();
        $this->view->system->versionID = $sVersionID;

        // Load Config
        $this->config = Zend_Registry::get('config');
        $this->view->config = $this->config;

        $this->loadMeta();
    }

    /**
     * Load Meta tags
     */
    public function loadMeta() {
        $this->view->doctype('HTML5');
        $this->view->headTitle()->setSeparator(' :: ');
        $this->view->headTitle('Impleo CMS');
        $this->view->headMeta()->appendName('description', 'test');
        $this->view->headMeta()->appendName('keywords', 'test');

        $this->view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        $this->view->jQuery()->addStylesheet($this->config->system->url . '/modules/jquery/css/black-tie/jquery-ui-1.8rc3.custom.css')
                   ->setLocalPath($this->config->system->url . '/modules/jquery/jquery-1.4.2.min.js')
                   ->setUiLocalPath($this->config->system->url . '/modules/jquery/jquery-ui-1.8rc3.custom.min.js');
    }

    /**
     * @todo adding functions headScript, headStyle and so on.
     */
}