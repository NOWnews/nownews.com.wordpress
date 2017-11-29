<?php
namespace WPRemoteMediaExt\RemoteMediaExt\Accounts\Instagram;

use WPRemoteMediaExt\RemoteMediaExt\Accounts\AbstractRemoteMedia;

/*
* Instagram Media Class
*/
class RemoteMedia extends AbstractRemoteMedia
{

    public function __construct($metadata = array())
    {
        $this->metadata = $metadata;

        $this->type = 'image';

        if (!empty($this->metadata->is_video) ||
            (is_array($this->metadata) && !empty($this->metadata['is_video']) &&
            $this->metadata['is_video'] != 'false')
        ) {
            $this->type = 'embed';
        }
    }

    /**
     * Prepares a media object for JS, where it is expected
     * to be JSON-encoded and fit into an Attachment model.
     *
     * @return array Array of attachment details.
     */
    public function toMediaManagerAttachment()
    {
        $this->metadata->ocs_link = 'https://www.instagram.com/p/'.$this->metadata->code;

        $attachment = array_merge(
            $this->getBasicAttachment(),
            array(
                'id'          => $this->metadata->id,
                'title'       => $this->metadata->code,
                'filename'    => $this->metadata->code,
                'url'         => $this->metadata->ocs_link,
                'link'        => $this->metadata->ocs_link,
                'alt'         => '',
                'author'      => isset($this->metadata->ocs_user_full_name) ? $this->metadata->ocs_user_full_name : '',
                'description' => '',
                'caption'     => isset($this->metadata->caption) ? trim($this->metadata->caption) : '', //limit word count?
                'name'        => $this->metadata->code,
                'status'      => 'inherit',
                'uploadedTo'  => 0,
                'date'        => $this->metadata->date * 1000,
                'modified'    => $this->metadata->date * 1000,
                'menuOrder'   => 0,
                'mime'        => 'remote/instagram',
                'subtype'     => $this->type,
                'icon'        => $this->metadata->thumbnail_src,
                'dateFormatted' => mysql2date(get_option('date_format'), $this->metadata->date),
                'nonces'      => array(
                    'update' => false,
                    'delete' => false,
                ),
                'editLink'   => false,
            )
        );
        
        if ($this->type === 'image') {
            $attachment['url'] = $this->metadata->display_src;
            
            $attachment['width'] = intval($this->metadata->dimensions->width);
            $attachment['height'] = intval($this->metadata->dimensions->height);

            $attachment['sizes'] = $this->getImageSizes(
                $attachment['width'],
                $attachment['height'],
                $attachment['url']
            );
        }

        $attachment['remotedata'] = $this->metadata;
        return $attachment;
    }
}
