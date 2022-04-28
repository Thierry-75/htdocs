<?php

class YoutubeWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('youtube_widget','Youtube Widget','');
    }

    public function widget($arg,$instance)
    {
        echo 'bonjour';
    }

    public function form($instance)
    {

    }

    public function update($newInstance, $oldinstance)
    {
        return [];
    }
}