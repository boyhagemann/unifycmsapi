<?php

/**
 * Class Action
 *
 * @property Resource $resource
 */
class Action extends Eloquent
{
    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resource()
    {
        return $this->belongsTo('Resource');
    }

    /**
     * @param array $config
     */
    public function setViewConfigAttribute(Array $config)
    {
        $this->attributes['view_config'] = json_encode($config);
    }

    /**
     * @return array
     */
    public function getViewConfigAttribute()
    {
        return json_decode($this->attributes['view_config'], true);
    }
}