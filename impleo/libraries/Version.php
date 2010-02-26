<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-22::22.50
     * @version			v1.0 2010-02-24::22.56
     */

class Version {
    public $version = 'Impleo CMS 1.0 Pre Alpha';
    public $versionID = '1.0 Pre Alpha';

    /**
     * @return <type> version
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * @return <type> versionID
     */
    public function getVersionID() {
        return $this->versionID;
    }
}