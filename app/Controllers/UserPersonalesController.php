<?php

namespace Controllers;

use Illuminate\Support\Facades\Auth;
use Tricks\Repositories\PersonalRepositoryInterface;
use Tricks\Repositories\TrickRepositoryInterface;



class UserPersonalesController extends BaseController
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
    protected $personales;



    /**
     * Create a new TrickController instance.
     *
     * @param  \Tricks\Repositories\TrickRepositoryInterface  $trick
     * @param  \Tricks\Repositories\PersonalRepositoryInterface  $personales
     * @return void
     */
    public function __construct(
        TrickRepositoryInterface $trick,
        PersonalRepositoryInterface $personales
    ) {
        parent::__construct();

        $this->beforeFilter('auth');
        $this->beforeFilter('trick.owner', [
            'only' => [ 'getEdit', 'postEdit', 'getDelete' ]
        ]);

        $this->trick      = $trick;
        $this->personales       = $personales;
    }

    /**
     * Show the create new trick page.
     *
     * @return \Response
     */
    public function getNew()
    {
        $personalList      = $this->personales->listAll();
        

        $this->view('personales.new', compact('personalList'));
    }

    /**
     * Handle the creation of a new trick.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postNew()
    {
        $form = $this->personales->getCreationForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data = $form->getInputData();
        $data['user_id'] = Auth::user()->id;

        $personal = $this->personales->create($data);

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
        $personal        = $this->personales->findBySlug($slug);
        $personalList      = $this->personales->listAll();
        

        $this->view('personales.edit', [
            'personalList'            => $personalList,
            'trick'              => $trick,
            'personal'               => $personal
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
        $personal = $this->personales->findBySlug($slug);
        $form  = $this->personales->getEditForm($personal->id);

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        $data  = $form->getInputData();
        $personal = $this->personales->edit($personal, $data);

        return $this->redirectRoute('personales.edit', [ $personal->slug ], [
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

        $trick->personal()->detach();
        $trick->delete();

        return $this->redirectRoute('user.index', null, [
            'success' => \Lang::get('user_tricks.trick_deleted')
        ]);
    }
}
