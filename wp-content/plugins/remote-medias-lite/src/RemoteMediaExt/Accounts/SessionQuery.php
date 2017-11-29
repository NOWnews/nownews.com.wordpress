<?php
namespace WPRemoteMediaExt\RemoteMediaExt\Accounts;

use WPRemoteMediaExt\WPCore\Cache\Transient;

class SessionQuery
{
    static $domain = 'ocs';

    protected $key;
    protected $data = array();
    protected $isFull = false;
    protected $isLoadNeeded = false;

    protected $dataTransient;
    protected $paramsTransient;

    public function __construct($key)
    {
        $this->setKey($key);

        $this->dataTransient   = new Transient(self::$domain.$this->key, 15*MINUTE_IN_SECONDS);
        $this->paramsTransient = new Transient(self::$domain.$this->keyparams, 15*MINUTE_IN_SECONDS);
    }

    public static function reset()
    {
        global $wpdb;

        $wpdb->query("DELETE FROM $wpdb->options WHERE `option_name` LIKE ('%transient_timeout_".self::$domain."%')");
        $wpdb->query("DELETE FROM $wpdb->options WHERE `option_name` LIKE ('%transient_".self::$domain."%')");
    }

    public function setKey($key)
    {
        $this->key = $key;
        $this->keyparams = $key.'_params';

        return $this;
    }

    public function getLastPage()
    {
        $params = $this->paramsTransient->get();
        if (empty($params) || empty($params['lastpage'])) {
            return 0;
        }

        return $params['lastpage'];
    }

    /*
    * When run after a get method this return true if another cache load is needed to complete results
    * 
    * @return true if load is needed, false otherwise
    */
    public function isLoadNeeded()
    {
        return $this->isLoadNeeded;
    }

    public function load($newdata, $fullcount = 40)
    {
        $params = $this->paramsTransient->get();
        $data   = $this->dataTransient->get();

        if ($data === false) {
            $data = array();
        }
        if ($params === false) {
            $params = array();
            $params['lastpage'] = 0;
        }

        $data = array_merge($data, $newdata);
        $params['lastpage'] = $params['lastpage'] + 1;
        $params['full'] = false;

        if (count($data) < $fullcount) {
            $params['full'] = true;
        }

        //Update cache with added data and params
        $this->paramsTransient->set($params);
        $this->dataTransient->set($data);
    }

    public function setFull($full = true)
    {
        $params = $this->paramsTransient->get();
        if (empty($params)) {
            $params = array();
        }
        $params['full'] = $full;
        $this->paramsTransient->set($params);
        $this->isFull = $full;
    }

    public function isFull()
    {
        $params = $this->paramsTransient->get();
        if (empty($params) || empty($params['full'])) {
            return false;
        }

        return $params['full'];
    }

    public function clear()
    {
        $this->dataTransient->delete();
        $this->paramsTransient->delete();

        $this->isLoadNeeded = true;
    }

    public function getData()
    {
        $data = $this->dataTransient->get();
        if ($data === false) {
            return null;
        }
        
        return $data;
    }

    /*
    * @return null if no data fetched
    */
    public function get($page = 1, $perpage = 40)
    {

        $data = $this->getData();
        if (empty($data) && !$this->isFull()) {
            return null;
        }

        $page    = intval($page);
        $perpage = intval($perpage);

        $offset = ($page - 1) * $perpage;

        if (!isset($data[$offset])) {
            return $this->isFull() ? array() : null;
        }

        $return = array_slice($data, $offset, $perpage);
        if (count($return) != $perpage) {

            $this->isLoadNeeded = true;
        }

        return $return;
    }
}
