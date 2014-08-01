<?php

/**
 * Class Element
 *
 * @property Resource $resource
 * @property Field[] $fields
 */
class Element extends Eloquent
{
    protected $visible = ['name', 'type', 'label', 'resource', 'fields'];

    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resource()
    {
        return $this->belongsTo('Resource');
    }

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields()
    {
        return $this->hasMany('Field');
    }

}