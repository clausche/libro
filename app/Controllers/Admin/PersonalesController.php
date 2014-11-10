<?php

namespace Controllers\Admin;

use Controllers\BaseController;
use Tricks\Repositories\PersonalRepositoryInterface;

class PersonalesController extends BaseController
{
    /**
     * Personal repository.
     *
     * @var \Tricks\Repositories\TagRepositoryInterface
     */
    protected $personales;

    /**
     * Create a new PersonalesController instance.
     *
     * @param  \Tricks\Repositories\PersonalRepositoryInterface  $tags
     * @return void
     */
    public function __construct(PersonalRepositoryInterface $personales)
    {
        parent::__construct();

        $this->personales = $personales;
    }

    /**
     * Show the tags index page.
     *
     * @return \Response
     */
    public function getIndex()
    {
        $personales = $this->personales->findAll();

        $this->view('admin.personales.list', compact('personales'));
    }

    /**
     * Delete a tag from the database.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $this->personales->delete($id);

        return $this->redirectRoute('admin.personales.index');
    }

    /**
     * Show the tag edit form.
     *
     * @param  mixed $id
     * @return \Response
     */
    public function getView($id)
    {
        $personal = $this->personales->findById($id);

        $this->view('admin.personales.edit', compact('personal'));
    }

    /**
     * Handle the creation of a tag.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
        $form = $this->personales->getForm();

        if (! $form->isValid()) {
            return $this->redirectRoute('admin.personales.index')
                        ->withErrors($form->getErrors())
                        ->withInput();
        }

        $personal = $this->personales->create($form->getInputData());

        return $this->redirectRoute('admin.personales.index');
    }

    /**
     * Handle the editing of a tag.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postView($id)
    {
        $form = $this->personales->getForm();

        if (! $form->isValid()) {
            return $this->redirectRoute('admin.personales.view', $id)
                        ->withErrors($form->getErrors())
                        ->withInput();
        }

        $personal = $this->personales->update($id, $form->getInputData());

        return $this->redirectRoute('admin.personales.view', $id);
    }
}
