<?php
namespace WPRemoteMediaExt\RemoteMediaExt\Accounts\Instagram;

use WPRemoteMediaExt\RemoteMediaExt\Accounts\AbstractRemoteAccount;
use WPRemoteMediaExt\RemoteMediaExt\Accounts\AbstractRemoteService;
use WPRemoteMediaExt\RemoteMediaExt\Accounts\SessionQuery;
use WPRemoteMediaExt\RemoteMediaExt\Library\MediaTemplate;
use WPRemoteMediaExt\WPCore\Cache\Transient;
use WPRemoteMediaExt\WPCore\View;
use WPRemoteMediaExt\WPForms\FieldSet;

class Service extends AbstractRemoteService
{
    public function __construct()
    {
        parent::__construct(__('Instagram', 'remote-medias-lite'), 'instagram');

        $client = Client::factory();
        $this->setClient($client);
    }

    public function init()
    {
        if (is_admin()) {

            $this->mediaSettings = array('uploadTemplate' => 'media-upload-instagram-upgrade');
            $this->hook(new MediaTemplate(new View($this->getViewsPath().'admin/media-upload-instagram.php')));

            //FieldSets need to be initialized early because they hook needed JS and CSS for fields added
            $this->initFieldSet();
        }
    }

    public function initFieldSet()
    {
        $this->fieldSet = new FieldSet();
        $field = array(
            'label' => __("Instagram Username", 'remote-medias-lite'),
            'type' => 'Text',
            'class' => $this->getSlug(),
            'id' => 'remote_user_id',
            'name' => 'account_meta['.$this->getSlug().'][instagram_remote_user_id]',
            'desc' => __("Insert the Instagram user for this library", 'remote-medias-lite'),
        );
        $this->fieldSet->addField($field);
    }

    public function validate()
    {
        $params = array(
            'username' => $this->account->get('instagram_remote_user_id'),
        );
        try {
            $command = $this->client->getCommand('UserRequest', $params);
            $response = $this->client->execute($command);
        } catch (\Exception $e) {
            return false;
        }

        if (!empty($response) &&
            isset($response->user) &&
            isset($response->user->media) &&
            isset($response->user->media->nodes)
        ) {
            return true;
        }

        return false;
    }

    public function getUserInfo()
    {

        return false;
    }

    public function getUserMedias($page = 1)
    {
        $medias = array();

        $params = array(
            'username' => $this->account->get('instagram_remote_user_id'),
        );
        
        $pageDataTransient = new Transient('rmlInstagramTokens', 2*MINUTE_IN_SECONDS, array($params));
        $pageData = $pageDataTransient->get();

        if ($pageData === false) {
            $pageData = array();
        }

        //If cached already
        if (!empty($pageData[$page]) && !empty($pageData[$page]['data'])) {
            return $pageData[$page]['data'];
        }

        if (!empty($pageData[$page]) && !empty($pageData[$page]['end_cursor'])) {
            $params['max_id'] = $pageData[$page]['end_cursor'];
        }

        $command = $this->client->getCommand('UserRequest', $params);
        $response = $this->client->execute($command);

        if (!empty($response) &&
            isset($response->user) &&
            isset($response->user->media)
        ) {
            if (isset($response->user->media->nodes)) {
                $medias = $response->user->media->nodes;
                $pageData[$page]['data'] = $medias;
                $pageDataTransient->set($pageData);
            }

            //Set next page token if available
            if (isset($response->user->media->page_info) &&
                isset($response->user->media->page_info->has_next_page) &&
                $response->user->media->page_info->has_next_page &&
                !empty($response->user->media->page_info->end_cursor)
            ) {
                $pageData[$page+1]['end_cursor'] = $response->user->media->page_info->end_cursor;
                $pageDataTransient->set($pageData);
            }
        }
        
        return $medias;
    }

    //Thanks to https://github.com/Bolandish/PHP-Instagram-Grabber
    public function getUserAttachments()
    {
        $page = 1;
        $perpage = 40;
        $searchTerm = '';
        $medias = array();
        $cacheEnable = true;

        if (isset($_POST['query']['paged'])) {
            $page = absint($_POST['query']['paged']);
        }

        if (isset($_POST['query']['posts_per_page'])) {
            $perpage = absint($_POST['query']['posts_per_page']);
        }

        if (isset($_POST['query']['s'])) {
            $searchTerm = sanitize_text_field($_POST['query']['s']);
        }

        $mediaMinOffset = ($page - 1) * $perpage;

        $cacheKey = 'ig'.md5('ocsrmlig'.$this->account->get('instagram_remote_user_id'));
        
        $cache = new SessionQuery($cacheKey);

        //Clear cache if not needed
        if (!$cacheEnable && $page < 2) {
            $cache->clear();
        }

        $medias = $cache->get($page, $perpage);

        //If No Cache Load is needed return cached data
        if (!is_null($medias) && !$cache->isLoadNeeded()) {
            foreach ($medias as $i => $media) {
                $remoteMedia = new RemoteMedia($media);
                $remoteMedia->setAccount($this->getAccount());
                $attachments[$i] = $remoteMedia->toMediaManagerAttachment();
    
                //Make sure order stay the same has received
                $attachments[$i]['menuOrder'] = intval($mediaMinOffset + $i);
            }
    
            return $attachments;
        }
        
        $loadCount = 12;
        $pageToLoad = $cache->getLastPage() + 1;

        // Instagram query return always 12 max items per page
        //Always load 4 pages at a time since max per page is 12
        for ($instaPage = 0; $instaPage <= 3; $instaPage++) {
            $newmedias = $this->getUserMedias($pageToLoad + $instaPage);
            $cache->load($newmedias, $loadCount);

            if ($cache->isFull()) {
                var_dump('full');
                break;
            }
            
        }

        $medias = $cache->get($page, $perpage);

        $attachments = array();

        foreach ($medias as $i => $media) {
            $remoteMedia = new RemoteMedia($media);
            $remoteMedia->setAccount($this->getAccount());
            $attachments[$i] = $remoteMedia->toMediaManagerAttachment();

            //Make sure order stay the same has received
            $attachments[$i]['menuOrder'] = intval($mediaMinOffset + $i);
        }

        return $attachments;
    }
}
