<?php

/**
 * Class ActionMessage
 *
 * @property Resource $resource
 * @property Field $field
 */
class ActionMessage extends Eloquent
{
    protected $visible = ['status', 'body', 'field', 'path', 'action'];

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
    public function field()
    {
        return $this->belongsTo('Field');
    }

}