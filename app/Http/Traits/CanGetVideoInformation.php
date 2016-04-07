<?php

namespace W4P\Http\Traits;

use W4P\Models\Setting;
use Session;

trait CanGetVideoInformation
{
    /**
     * Gets the video provider given an url
     * @return null|string
     */
    public function getVideoProvider()
    {
        $videoProvider = null;

        if (strpos($this->video_url, 'watch?v=') !== false) {
            $videoProvider = "youtube";
        }
        if (strpos($this->video_url, 'vimeo.com/') !== false) {
            $videoProvider = "vimeo";
        }

        return $videoProvider;
    }

    /**
     * Get the player URL for the meta tag; this is the embedded version
     * @return null|string
     */
    public function getEmbed()
    {
        $provider = $this->getVideoProvider();
        if ($provider == "youtube") {
            return "https://www.youtube.com/embed/" . $this->getVideoId();
        }
        if ($provider == "vimeo") {
            return "https://player.vimeo.com/video/" . $this->getVideoId();
        }
        return null;
    }

    /**
     * Gets the thumbnail URL for a specific video
     * @return null|string
     */
    public function getThumbnailUrl()
    {
        $provider = $this->getVideoProvider();
        if ($provider == "youtube") {
            return "https://img.youtube.com/vi/" . $this->getVideoId() . "/0.jpg";
        }
        if ($provider == "vimeo") {
            // Get from DB
            $thumbnail_url = Setting::get('vimeo.thumbnail_url');
            if ($thumbnail_url == '') {
                // If thumbnail URL is null, fetch it
                $thumbnail_url = $this->cacheVimeoThumbnailUrl($this->getVideoId());
                if ($thumbnail_url != 'failed_thumb') {
                    return $thumbnail_url;
                } else {
                    return '';
                }
            } elseif ($thumbnail_url != 'failed_thumb') {
                // If thumbnail URL is not null and hasn't failed
                return $thumbnail_url;
            }
        }
        return "";
    }

    /**
     * Caches a Vimeo thumbnail URL after requesting it
     * @param mixed $id A Vimeo ID
     * @return thumbnail's url
     */
    public function cacheVimeoThumbnailUrl($id)
    {
        try {
            $data = file_get_contents("https://vimeo.com/api/v2/video/$id.json");
            $data = json_decode($data);
            Setting::set('vimeo.thumbnail_url', $data[0]->thumbnail_medium);
            return $data[0]->thumbnail_large;
        } catch (\Exception $ex) {
            Setting::set('vimeo.thumbnail_url', 'failed_thumb');
            Session::flash('info', 'There was an issue fetching the Vimeo thumbnail.');
        }
    }

    /**
     * Gets the video id for the video
     * @return null|string
     */
    public function getVideoId()
    {
        // Check the video provider
        switch ($this->getVideoProvider()) {
            case "vimeo":
                $array = explode("vimeo.com/", $this->video_url);
                $videoId = explode("/", last($array))[0];
                break;
            case "youtube":
                $array = explode("watch?v=", $this->video_url);
                $videoId = explode("&", last($array))[0];
                break;
            default:
                $videoId = null;
                break;
        }
        return $videoId;
    }
}
