<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paises';

    public $presenter = 'Tricks\Presenters\PaisPresenter';

    /**
     * Query the tricks that belong to the tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function ciudades()
	{
		return $this->hasMany('Tricks\Ciudad');
	}
    public function tricks()
    {
        return $this->belongsTo('Tricks\Trick');
    }
    public function tags()
    {
        return $this->hasMany('Tricks\Tag');
    }
}