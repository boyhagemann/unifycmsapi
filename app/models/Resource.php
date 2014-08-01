<?php

use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

/**
 * Class Resource
 *
 * @property Action[] $actions
 * @property Element[] $elements
 */
class Resource extends Eloquent implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    protected $fillable = ['uri', 'title'];

    protected $visible = ['id', 'uri', 'title', 'actions', 'elements'];

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions()
    {
        return $this->hasMany('Action');
    }

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elements()
    {
        return $this->hasMany('Element');
    }
}