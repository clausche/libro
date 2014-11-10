<?php

namespace Tricks\Presenters;

use Tricks\User;
use Tricks\Tag;
use Tricks\Trick;
use Tricks\Category;
use Tricks\Personal;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\HTML;
use McCool\LaravelAutoPresenter\BasePresenter;

class PersonalPresenter extends BasePresenter
{
    /**
     * Cache for whether the user has liked this trick.
     *
     * @var bool
     */
    protected $likedByUser = null;

    /**
     * Create a new TrickPresenter instance.
     *
     * @param  \Tricks\Trick  $tag
     * @return void
     */
    public function __construct(Personal $personal)
    {
        $this->resource = $personal;
    }

    /**
     * Get the edit link for this trick.
     *
     * @return string
     */
    public function editLink()
    {
        return URL::route('personales.edit', [ $this->resource->slug ]);
    }

    /**
     * Get the delete link for this trick.
     *
     * @return string
     */
    public function deleteLink()
    {
        return URL::route('personales.delete', [ $this->resource->slug ]);
    }

    /**
     * Get a readable created timestamp.
     *
     * @return string
     */
    public function timeago()
    {
        return $this->resource->created_at->diffForHumans();
    }

    /**
     * Get a readable created timestamp.
     *
     * @return string
     */
    public function actualizado()
    {
        return $this->resource->updated_at->diffForHumans();
    }

    
    /**
     * Get the meta description for this trick.
     *
     * @return string
     */
    public function pageDescription()
    {
        $description = $this->resource->description;
        $maxLength   = 160;
        $description = str_replace('"', '', $description);

        if (strlen($description) > $maxLength) {
            while (strlen($description) + 3 > $maxLength) {
                $description = $this->removeLastWord($description);
            }

            $description .= '...';
        }

        return e($description);
    }

    /**
     * Get the meta title for this trick.
     *
     * @return string
     */
    public function pageTitle()
    {
        $title     = $this->resource->title;
        $baseTitle = ' | Libro-Exterior.com';
        $maxLength = 70;

        if (strlen($title.$baseTitle) > $maxLength) {
            while (strlen($title.$baseTitle) > $maxLength) {
                $title = $this->removeLastWord($title);
            }
        }

        return e($title);
    }

    /**
     * Remove the last word from a given string.
     *
     * @param  string  $string
     * @return string
     */
    protected function removeLastWord($string)
    {
        $split = explode(' ', $string);

        array_pop($split);

        return implode(' ', $split);
    }

    /**
     * Get the tag URI for this trick.
     *
     * @return string
     */
    public function tagUri()
    {
        $url = parse_url(route('tricks.show', $this->resource->slug));

        $output  = 'tag:';
        $output .= $url['host'] . ',';
        $output .= $this->resource->created_at->format('d-m-Y') . ':';
        $output .= $url['path'];

        return $output;
    }

    /**
     * Get the ciudad URI for this trick.
     *
     * @return string
     */
    public function CiudadUri()
    {
        $url = parse_url(route('tricks.show', $this->resource->slug));

        $output  = 'ciudad:';
        $output .= $url['host'] . ',';
        $output .= $this->resource->created_at->format('d-m-Y') . ':';
        $output .= $url['path'];

        return $output;
    }
}
