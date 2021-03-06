<?php

namespace Controllers;

use Illuminate\Support\Facades\Auth;
use Tricks\Repositories\TagRepositoryInterface;
use Tricks\Repositories\PersonalRepositoryInterface;
use Tricks\Repositories\CiudadRepositoryInterface;
use Tricks\Repositories\CountryRepositoryInterface;
use Tricks\Repositories\TrickRepositoryInterface;
use Tricks\Repositories\CategoryRepositoryInterface;

class UserTricksController extends BaseController
{
    /**
     * Trick repository.
     *
     * @var \Tricks\Repositories\TrickRepositoryInterface
     */
    protected $trick;

    /**
     * Tag repository.
     *
     * @var \Tricks\Repositories\TagRepositoryInterface
     */
    protected $tags;

    /**
     * Personal repository.
     *
     * @var \Tricks\Repositories\PersonalRepositoryInterface
     */
    protected $personales;

    /**
     * Country repository.
     *
     * @var \Tricks\Repositories\CountryRepositoryInterface
     */
    protected $countries;

    /**
     * Ciudad repository.
     *
     * @var \Tricks\Repositories\TagRepositoryInterface
     */
    protected $ciudades;

    /**
     * Category repository.
     *
     * @var \Tricks\Repositories\CategoryRepositoryInterface
     */
    protected $categories;

    /**
     * Create a new TrickController instance.
     *
     * @param  \Tricks\Repositories\TrickRepositoryInterface  $trick
     * @param  \Tricks\Repositories\TagRepositoryInterface  $tags
     * @param  \Tricks\Repositories\PersonalRepositoryInterface  $personales
     * @param  \Tricks\Repositories\CiudadRepositoryInterface  $ciudades
     * @param  \Tricks\Repositories\CategoryRepositoryInterface  $categories
     * @return void
     */
    public function __construct(
        TrickRepositoryInterface $trick,
        TagRepositoryInterface $tags,
        PersonalRepositoryInterface  $personales,
        CiudadRepositoryInterface $ciudades,
        CountryRepositoryInterface $countries,
        CategoryRepositoryInterface $categories
    ) {
        parent::__construct();

        $this->beforeFilter('auth');
        $this->beforeFilter('trick.owner', [
            'only' => [ 'getEdit', 'postEdit', 'getDelete' ]
        ]);

        $this->trick      = $trick;
        $this->tags       = $tags;
        $this->personales = $personales;
        $this->ciudades   = $ciudades;
        $this->countries   = $countries;
        $this->categories = $categories;
    }

    /**
     * Show the create new trick page.
     *
     * @return \Response
     */
    public function getNew()
    {
        $tagList      = $this->tags->listAll();
        $personalList = $this->personales->listAll();
        $ciudadList   = $this->ciudades->listAll();
        $categoryList = $this->categories->listAll();
        $countryList  = $this->countries->listAll();

        $this->view('tricks.new', compact('tagList', 'personalList', 'ciudadList', 'categoryList', 'countryList'));
    }

    /**
     * Handle the creation of a new trick.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNew()
    {
        $form = $this->trick->getCreationForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data = $form->getInputData();
        $data['user_id'] = Auth::user()->id;

        $trick = $this->trick->create($data);

        return $this->redirectRoute('user.index');
    }

    /**
     * Show the edit trick page.
     *
     * @param  string $slug
     * @return \Response
     */
    public function getEdit($slug)
    {
        $trick        = $this->trick->findBySlug($slug);
        $tagList      = $this->tags->listAll();
        $personalList = $this->personales->listAll();
        $ciudadList   = $this->ciudades->listAll();
        $categoryList = $this->categories->listAll();
        $countryList = $this->countries->listAll();

        $selectedTags       = $this->trick->listTagsIdsForTrick($trick);
        $selectedPersonales = $this->trick->listPersonalesIdsForTrick($trick);
        $selectedCiudades   = $this->trick->listCiudadesIdsForTrick($trick);
        $selectedCategories = $this->trick->listCategoriesIdsForTrick($trick);

        $this->view('tricks.edit', [
            'tagList'            => $tagList,
            'personalList'       => $personalList,
            'ciudadList'         => $ciudadList,
            'countryList'        => $countryList,    
            'selectedTags'       => $selectedTags,
            'selectedPersonales' => $selectedPersonales,
            'selectedCiudades'   => $selectedCiudades,
            'categoryList'       => $categoryList,
            'selectedCategories' => $selectedCategories,
            'trick'              => $trick
        ]);
    }

    /**
     * Handle the editing of a trick.
     *
     * @param  string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($slug)
    {
        $trick = $this->trick->findBySlug($slug);
        $form  = $this->trick->getEditForm($trick->id);

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data  = $form->getInputData();
        $trick = $this->trick->edit($trick, $data);

        return $this->redirectRoute('tricks.edit', [ $trick->slug ], [
            'success' => "Actualizado" 
            //\Lang::get('user_tricks.trick_updated')
        ]);
    }

    /**
     * Delete a trick from the database.
     *
     * @param  string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($slug)
    {
        $trick = $this->trick->findBySlug($slug);

        $trick->tags()->detach();
        $trick->personales()->detach();
        $trick->ciudades()->detach();
        $trick->categories()->detach();
        $trick->delete();

        return $this->redirectRoute('user.index', null, [
            'success' => \Lang::get('user_tricks.trick_deleted')
        ]);
    }
}
