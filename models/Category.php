<?php
class Category extends FosStreaming {

    public function streams()
    {
        return $this->hasMany('Stream', 'cat_id', 'id');
    }
}