<?php

/**
 * Class Element
 *
 * @property Resource $resource
 */
class Element extends Eloquent
{
    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resource()
    {
        return $this->belongsTo('Resource');
    }

}