<?php

namespace Tricks;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personales';
    public $presenter = 'Tricks\Presenters\PersonalPresenter';

    /**
     * Query the tricks that belong to the tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function tricks()
	{
		return $this->hasOne('Tricks\Trick');
	}
    public function paises()
    {
        return $this->hasOne('Tricks\Pais');

    }
    public function tags()
    {
        return $this->hasOne('Tricks\Tag');
    }
}
