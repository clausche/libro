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
    //public $presenter = 'Tricks\Presenters\TagPresenter';

    /**
     * Query the tricks that belong to the tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function tricks()
	{
		return $this->belongsToMany('Tricks\Trick');
	}
}
