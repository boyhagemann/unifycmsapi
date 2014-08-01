<?php

/**
* Node
 *
 * @property Action $action
*/
class Node extends Baum\Node
{
    protected $visible = ['label', 'uri', 'action_id', 'children'];

    /**
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('Action');
    }
}
