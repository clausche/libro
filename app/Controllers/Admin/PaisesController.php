<?php

namespace Controllers\Admin;

use Controllers\BaseController;
use Tricks\Repositories\PaisRepositoryInterface;

class PaisesController extends BaseController
{
    /**
     * Ciudad repository.
     *
     * @var \Tricks\Repositories\CiudadRepositoryInterface
     */
    protected $paises;

    /**
     * Create a new CiudadesController instance.
     *
     * @param  \Tricks\Repositories\CiudadRepositoryInterface  $ciudades
     * @return void
     */
    public function __construct(PaisRepositoryInterface $paises)
    {
        parent::__construct();

        $this->paises = $paises;
    }

    /**
     * Show the ciudades index page.
     *
     * @return \Response
     */
    public function getIndex()
    {
        $paises = $this->paises->findAll();

        $this->view('admin.paises.list', compact('paises'));
    }

    /**
     * Delete a ciudad from the database.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
        $this->paises->delete($id);

        return $this->redirectRoute('admin.paises.index');
    }

    /**
     * Show the ciudad edit form.
     *
     * @param  mixed $id
     * @return \Response
     */
    public function getView($id)
    {
        $pais = $this->paises->findById($id);

        $this->view('admin.paises.edit', compact('pais'));
    }

    /**
     * Handle the creation of a ciudad.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
        $form = $this->paises->getForm();

        if (! $form->isValid()) {
            return $this->redirectRoute('admin.paises.index')
                        ->withErrors($form->getErrors())
                        ->withInput();
        }

        $ciudad = $this->paises->create($form->getInputData());

        return $this->redirectRoute('admin.paises.index');
    }

    /**
     * Handle the editing of a ciudad.
     *
     * @param  mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postView($id)
    {
        $form = $this->ciudades->getForm();

        if (! $form->isValid()) {
            return $this->redirectRoute('admin.paises.view', $id)
                        ->withErrors($form->getErrors())
                        ->withInput();
        }

        $ciudad = $this->ciudades->update($id, $form->getInputData());

        return $this->redirectRoute('admin.paises.view', $id);
    }
}
