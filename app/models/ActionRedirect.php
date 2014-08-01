<?php

/**
 * Class ActionRedirect
 *
 * @property Resource $resource
 */
class ActionRedirect extends Eloquent
{
    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('Action');
    }

}