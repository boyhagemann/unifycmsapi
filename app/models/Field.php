<?php

/**
 * Class Field
 *
 * @property Action $action
 * @property Element $element
 */
class Field extends Eloquent
{
    protected $visible = ['view', 'view_config', 'order', 'action', 'element'];

    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('Action');
    }

    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function element()
    {
        return $this->belongsTo('Element');
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