<?php

/**
 * Class ActionResponse
 *
 * @property Resource $resource
 */
class ActionResponse extends Eloquent
{
    protected $visible = ['status', 'name', 'value', 'action'];

    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('Action');
    }

}