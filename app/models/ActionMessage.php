<?php

/**
 * Class ActionMessage
 *
 * @property Resource $resource
 */
class ActionMessage extends Eloquent
{
    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('Action');
    }

}