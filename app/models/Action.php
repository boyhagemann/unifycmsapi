<?php

/**
 * Class Action
 *
 * @property Resource $resource
 * @property ActionResponse[] $responses
 * @property ActionMessage[] $messages
 * @property ActionRedirect[] $redirects
 * @property Node $node
 */
class Action extends Eloquent
{
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
    public function responses()
    {
        return $this->hasMany('ActionResponse');
    }

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany('ActionMessage');
    }

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function redirects()
    {
        return $this->hasMany('ActionRedirect');
    }

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function node()
    {
        return $this->hasOne('Node');
    }

    /**
     * @param array $config
     */
    public function setViewConfigAttribute(Array $config)
    {
        $this->attributes['view_config'] = json_encode($config);
    }

    /**
     * @return array
     */
    public function getViewConfigAttribute()
    {
        return json_decode($this->attributes['view_config'], true);
    }
}