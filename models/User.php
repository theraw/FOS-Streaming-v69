<?php
class User extends FosStreaming {

    protected $table = 'users';

    public function categories()
    {
        return $this->belongsToMany('Category');
    }
    
    public function getCategoryNamesAttribute()
    {
        $return = "";
        $prefix = '';
        foreach($this->categories as $category)
        {
            $return .= $prefix . ' ' . $category->name . '';
            $prefix = ', ';
        }

        return $return;
    }

    public function activity()
    {
        return $this->hasMany('Activity');
    }

    public function laststream()
    {
        return $this->hasOne('Stream', 'id', 'last_stream');
    }
}