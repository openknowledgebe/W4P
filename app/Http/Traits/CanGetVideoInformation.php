<?php

namespace W4P\Http\Traits;

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
