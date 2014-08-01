<?php

/**
 * Class ActionResponse
 *
 * @property Resource $resource
 */
class ActionResponse extends Eloquent
{
    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('Action');
    }

}