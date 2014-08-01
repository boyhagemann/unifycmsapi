<?php

/**
 * Class Node
 *
 * @property Action $action
 */
class Node extends Eloquent
{
    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('Action');
    }

}