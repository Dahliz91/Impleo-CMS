<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-23::22.42
     * @version			v1.0 2010-03-03::22.48
     */


class Admin_ErrorController extends ImpleoCMS_ControllerAdmin {
    /**
     * errorAction()
     *
     * @return the main ErrorAction
     */
    public function errorAction() {
        $errors = $this->_getParam('error_handler');
        switch($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_MODULE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- Controller or Action not found
                $this->getResponse()->setRawHeader('HTTP/1.1 404 Not Found');
                $this->view->title = 'HTTP/1.1 404 Not Found';
                $this->view->message = 'Sorry, the page you requested was not found';
                break;
            default:
                // Application Error
                $this->getResponse()->setHttpResponseCode(500);
                $this->view->title = 'Application Error';
                $this->view->message = $errors->exception;
                break;
        }

        $this->view->exception	= $errors->exception;
        $this->view->request	= $errors->request;
    }
}