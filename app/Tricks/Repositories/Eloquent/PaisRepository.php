<?php

namespace Tricks\Repositories\Eloquent;

use Tricks\User;
use Tricks\Trick;
use Tricks\Ciudad;
use Tricks\Pais;
use Tricks\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Tricks\Services\Forms\TrickEditForm;
use Tricks\Services\Forms\PaisForm;
use Tricks\Services\Forms\PaisEditForm;
use Illuminate\Database\Eloquent\Collection;
use Tricks\Exceptions\PaisNotFoundException;
use Tricks\Repositories\PaisRepositoryInterface;

class PaisRepository extends AbstractRepository implements PaisRepositoryInterface
{
    /**
     * Create a new DbCiudadRepository instance.
     *
     * @param  \Tricks\Ciudad $ciudades
     * @return void
     */
    public function __construct(Pais $pais)
    {
        $this->model = $pais;
    }

    /**
     * Get an array of key-value (id => name) pairs of all ciudades.
     *
     * @return array
     */
    /*public function listAll()
    {
        $ciudades = $this->model->lists('name', 'id');

        return $ciudades;
    }*/
    public function listAll()
    {
        $paises = $this->model->orderBy('name', 'asc')->lists('name', 'id');
        return $paises;
    }

    /**
     * Find all ciudades.
     *
     * @param  string  $orderColumn
     * @param  string  $orderDir
     * @return \Illuminate\Database\Eloquent\Collection|\Tricks\Ciudad[]
     */
    /*public function findAll($orderColumn = 'created_at', $orderDir = 'desc')
    {
        $ciudades = $this->model
                     ->orderBy($orderColumn, $orderDir)
                     ->get();

        return $ciudades;
    }
*/
    public function findAll()
    {
        $paises = $this->model
                     
                     ->get();

        return $paises;
    }

    /**
     * Find a ciudad by id.
     *
     * @param  mixed  $id
     * @return \Tricks\Ciudad
     */
    public function findById($id)
    {
        return $this->model->find($id);
        //return $this->model->whereId($id)->get();
    }

    /**
     * Find all ciudades with the associated number of tricks.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Tricks\Ciudad[]
     */
    public function findAllWithTrickCount($per_page = 10)
    {
        /*return $this->model
                    ->select('ciudad.name','ciudad.slug',DB::raw('COUNT(tricks.id) as trick_count'))
                    ->leftJoin('ciudad_trick', 'ciudades.id', '=', 'ciudad_trick.ciudad_id')
                    ->leftJoin('tricks', 'tricks.id', '=', 'ciudad_trick.trick_id')
                    ->groupBy('ciudades.slug')
                    ->orderBy('trick_count', 'desc')
                    ->paginate($per_page);*/
    }

    public function findAllWithCiudadCount($per_page = 10)
    {
        /*return $this->model
                    ->select('ciudades.name','ciudades.slug',DB::raw('COUNT(tricks.id) as trick_count'))
                    ->leftJoin('ciudad_trick', 'ciudades.id', '=', 'ciudad_trick.ciudad_id')
                    ->leftJoin('tricks', 'tricks.id', '=', 'ciudad_trick.trick_id')
                    ->groupBy('ciudades.slug')
                    ->orderBy('trick_count', 'desc')
                    ->paginate($per_page);*/
    }

    public function findAllWithPaisCount($per_page = 10)
    {
        /*return $this->model
                    ->select('paises.name','paises.slug',DB::raw('COUNT(tricks.id) as trick_count'))
                    ->leftJoin('ciudad_trick', 'ciudades.id', '=', 'ciudad_trick.ciudad_id')
                    ->leftJoin('tricks', 'tricks.id', '=', 'ciudad_trick.trick_id')
                    ->groupBy('ciudades.slug')
                    ->orderBy('trick_count', 'desc')
                    ->paginate($per_page);*/
    }

    /**
     * Find a ciudades by the given slug.
     *
     * @param  string $slug
     * @return \Tricks\Ciudad
     */
    public function findBySlug($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }

    /**
     * Create a new ciudad in the database.
     *
     * @param  array  $data
     * @return \Tricks\Ciudad
     */
    public function create(array $data)
    {
        $pais = $this->getNew();

        $pais->name = $data['name'];
        $pais->slug = Str::slug($pais->name, '-');

        $pais->save();

        return $pais;
    }

    /**
     * Update the pais in the database.
     *
     * @param  \Tricks\Pais $pais
     * @param  array $data
     * @return \Tricks\Pais
     */
    public function edit(Pais $pais, array $data)
    {
        //$tag->user_id = $data['user_id'];
        $pais->name       = e($data['name']);
        $pais->slug        = Str::slug($data['name'], '-');
        $pais->headofstate = e($data['headofstate']);
        //$ciudad->iso2 = e($data['iso2']);
        //$tag->code        = $data['code'];

        $pais->save();

        //$tag->tags()->sync($data['tags']);
        //$tag->ciudades()->sync($data['ciudades']);
        //$tag->categories()->sync($data['categories']);

        return $pais;
    }

    /**
     * Update the specified pais in the database.
     *
     * @param  mixed  $id
     * @param  array  $data
     * @return \Tricks\Pais
     */
    public function update($id, array $data)
    {
        $pais = $this->findById($id);

        $pais->name = $data['name'];
        $pais->slug = Str::slug($pais->name, '-');
        $pais->headofstate = $data['headofstate'];

        $pais->save();

        return $pais;
    }

    /**
     * Delete the specified ciudad from the database.
     *
     * @param  mixed  $id
     * @return void
     */
    public function delete($id)
    {
        $ciudad = $this->findById($id);

        $ciudad->tricks()->detach();

        $ciudad->delete();
    }

    /**
     * Get the ciudad create/update form service.
     *
     * @return \Tricks\Services\Forms\CiudadForm
     */
    public function getForm()
    {
        return new PaisForm;
    }
    /**
     * Get the tag creation form service.
     *
     * @return \Tricks\Services\Forms\PaisForm
     */
    public function getCreationForm()
    {
        return new PaisForm;
    }
    /**
     * Get the ciudad edit form service.
     *
     * @return \Tricks\Services\Forms\CiudadEditForm
     */
    public function getEditForm($id)
    {
        return new PaisEditForm($id);
    }
}
