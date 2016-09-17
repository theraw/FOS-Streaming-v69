<?php
class Activity extends FosStreaming {

    protected $table = 'activity';

    public function user()
    {
        return $this->hasOne('user', 'id', 'user_id');
    }

    public function stream()
    {
        
        return $this->hasOne('stream', 'id', 'stream_id');
    }
}