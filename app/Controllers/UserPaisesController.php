<?php

namespace Controllers;

use Illuminate\Support\Facades\Auth;
use Tricks\Repositories\TagRepositoryInterface;
use Tricks\Repositories\CiudadRepositoryInterface;
use Tricks\Repositories\CountryRepositoryInterface;
use Tricks\Repositories\TrickRepositoryInterface;
use Tricks\Repositories\PaisRepositoryInterface;
use Tricks\Repositories\CategoryRepositoryInterface;


class UserPaisesController extends BaseController
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
     * Ciudad repository.
     *
     * @var \Tricks\Repositories\TagRepositoryInterface
     */
    protected $paises;

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
     * @param  \Tricks\Repositories\CiudadRepositoryInterface  $ciudades
     * @param  \Tricks\Repositories\CategoryRepositoryInterface  $categories
     * @return void
     */
    public function __construct(
        TrickRepositoryInterface $trick,
        TagRepositoryInterface $tags,
        PaisRepositoryInterface $paises,
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
        $this->ciudades   = $ciudades;
        $this->paises   = $paises;
        $this->countries  = $countries;
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
        $ciudadList   = $this->ciudades->listAll();
        $categoryList = $this->categories->listAll();
        $countryList = $this->countries->listAll();

        $this->view('ciudades.new', compact('tagList', 'ciudadList', 'categoryList', 'countryList'));
    }

    /**
     * Handle the creation of a new trick.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNew()
    {
        $form = $this->tags->getCreationForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data = $form->getInputData();
        $data['user_id'] = Auth::user()->id;

        $trick = $this->tags->create($data);

        return $this->redirectRoute('user.index');
    }

    /**
     * Show the edit tag page.
     *
     * @param  string $slug
     * @return \Response
     */
    public function getEdit($slug)
    {
        $trick        = $this->trick->findAll();
        
        $ciudad        = $this->ciudades->findBySlug($slug);
        $pais        = $this->paises->findBySlug($slug);
        $ciudadList      = $this->ciudades->listAll();
        $paisList      = $this->paises->listAll();
        $tag        = $this->tags->findBySlug($slug);
        $tagList      = $this->tags->listAll();
        /*
        $categoryList = $this->categories->listAll();
        $countryList = $this->countries->listAll();*/


      /*  $selectedTags       = $this->tags->listTagsIdsForTrick($tag);
        $selectedCiudades   = $this->trick->listCiudadesIdsForTrick($trick);
        $selectedCategories = $this->trick->listCategoriesIdsForTrick($trick);*/

        $this->view('paises.edit', [
            'tagList'            => $tagList,
            'ciudadList'         => $ciudadList,
            'paisList'         => $paisList,
            
            /*
            'countryList'        => $countryList,    
            'selectedTags'       => $selectedTags,
            'selectedCiudades'   => $selectedCiudades,
            'categoryList'       => $categoryList,
            'selectedCategories' => $selectedCategories,*/
            'trick'              => $trick,
            'tag'               => $tag,
            'pais'               => $pais,
            'ciudad'            => $ciudad
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
        $pais = $this->paises->findBySlug($slug);
        $form  = $this->paises->getEditForm($pais->id);

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data  = $form->getInputData();
        $pais = $this->paises->edit($pais, $data);

        return $this->redirectRoute('ciudades.edit', [ $pais->slug ], [
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
        $trick->ciudades()->detach();
        $trick->categories()->detach();
        $trick->delete();

        return $this->redirectRoute('user.index', null, [
            'success' => \Lang::get('user_tricks.trick_deleted')
        ]);
    }
}