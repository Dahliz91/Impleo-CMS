<?php
    /**
     * @author		Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright	Copyright (c) 2010, Johan Dahlberg
     * @license		Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link		http://www.impleocms.se
     * @package		Impleo CMS 1.0 Pre Alpha
     *
     * @subpackage	Core Package
     * @since		v1.0 2010-02-22::12.00
     * @version		v1.0 2010-02-27::16.35
     */

    /**
     * This is the index file where the system is loaded.
     */
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    ini_set('error_reporting', -1);
    /*if(file_exists('./install/install.php')) {
        require './install/install.php';
    } else {*/
        defined('BASE_PATH')
            || define('BASE_PATH', realpath(dirname(__FILE__)));
        defined('APP_PATH')
            || define('APP_PATH', realpath(dirname(__FILE__) . '/../impleo'));
        defined('APP_ENV')
            || define('APP_ENV', (getenv('APP_ENV') ? getenv('APP_ENV') : 'production'));

        set_include_path(implode(PATH_SEPARATOR, array(
            APP_PATH . '/libraries',
            APP_PATH . '/models',
            get_include_path(),
        )));

        include_once(APP_PATH . '/libraries/Kernel.php');
        $kernel = new Kernel();
        $kernel->setEnviroment(APP_ENV);
        $kernel->initKernel(APP_PATH . '/config/config.xml');
    /*}*/