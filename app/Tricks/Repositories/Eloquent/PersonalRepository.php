<?php
 
namespace Tricks\Repositories\Eloquent;

use Disqus;
use Tricks\Personal;
use Tricks\Tag;
use Tricks\Ciudad;
use Tricks\User;
use Tricks\Trick;
use Tricks\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Tricks\Services\Forms\PersonalForm;
/*use Tricks\Services\Forms\TrickForm;
use Tricks\Services\Forms\TrickEditForm;*/
use Tricks\Services\Forms\PersonalEditForm;
use Illuminate\Database\Eloquent\Collection;
use Tricks\Repositories\TrickRepositoryInterface;
use Tricks\Repositories\PersonalRepositoryInterface;

class PersonalRepository extends AbstractRepository implements PersonalRepositoryInterface
{
    /**
     * Create a new DbTagRepository instance.
     *
     * @param  \Tricks\Tag $tags
     * @return void
     */
    public function __construct(Personal $personal)
    {
        $this->model = $personal;
    }

    /**
     * Get an array of key-value (id => name) pairs of all tags.
     *
     * @return array
     */
    public function listAll()
    {
        $personales = $this->model->lists('name', 'id');

        return $personales;
    }

    /**
     * Find all tags.
     *
     * @param  string  $orderColumn
     * @param  string  $orderDir
     * @return \Illuminate\Database\Eloquent\Collection|\Tricks\Tag[]
     */
    public function findAll($orderColumn = 'created_at', $orderDir = 'desc')
    {
        $personales = $this->model
                     ->orderBy($orderColumn, $orderDir)
                     ->get();

        return $personales;
    }

    /**
     * Find a tag by id.
     *
     * @param  mixed  $id
     * @return \Tricks\Tag
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

        /**
     * Find all the tags paginated.
     *
     * @param  integer $perPage
     * @return \Illuminate\Pagination\Paginator|\Tricks\Tag[]
     */
    public function BuscaTodosPaginado($perPage = 3)
    {
        $personales = $this->model->paginate($perPage);

        return $personales;
    }

    /**
     * Get a list of tag ids that are associated with the given trick.
     *
     * @param  \Tricks\Trick $trick
     * @return array
     */
    public function listPersonalesIdsForTrick(Personal $trick)
    {
        return $trick->tags->lists('id');
    }

    /**
     * Find all tricks order by the creation date paginated.
     *
     * @param  integer $per_page
     * @return \Illuminate\Pagination\Paginator|\Tricks\Trick[]
     */
    public function listarPorPagina($per_page = 6)
    {
        return $this->paginate($per_page = 6);
    }

    /**
     * Find all tags with the associated number of tricks.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Tricks\Tag[]
     */
    public function findAllWithTrickCount($per_page=10)
    {
       /* return $this->model
                    ->leftJoin('tag_trick', 'tags.id', '=', 'tag_trick.tag_id')
                    ->leftJoin('tricks', 'tricks.id', '=', 'tag_trick.trick_id')
                    ->groupBy('tags.slug')
                    ->orderBy('trick_count', 'desc')

                    ->get([
                        'tags.name',
                        'tags.slug',
                        DB::raw('COUNT(tricks.id) as trick_count')
                    ]);
        
       */
        $personales = $this->model
                    ->select('personales.name','personales.name','personales.slug',DB::raw('COUNT(tricks.id) as trick_count'))
                    ->leftJoin('personal_trick', 'personales.id', '=', 'personal_trick.personal_id')
                    ->leftJoin('tricks', 'tricks.id', '=', 'personal_trick.trick_id')
                    ->groupBy('personales.slug')
                    ->orderBy('trick_count', 'desc')
                    
                    ->paginate($per_page)
                    /*->get([
                        'tags.name',
                        'tags.slug',
                        DB::raw('COUNT(tricks.id) as trick_count')
                    ])*/
                    ;
                    

        return $personales;



    }

    /**
     * Find a tags by the given slug.
     *
     * @param  string $slug
     * @return \Tricks\Tag
     */
    public function findBySlug($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }

    /**
     * Create a new tag in the database.
     *
     * @param  array  $data
     * @return \Tricks\Tag
     */
    public function create(array $data)
    {
        $personal = $this->getNew();

        $personal->name = $data['name'];
        $personal->slug = Str::slug($personal->name, '-');
        $personal->titulo = $data['titulo'];
        $personal->cedula = $data['cedula'];
        $personal->email = $data['email'];

        $personal->save();

        return $personal;
    }

    /**
     * Update the tag in the database.
     *
     * @param  \Tricks\Tag $tag
     * @param  array $data
     * @return \Tricks\Tag
     */
    public function edit(Personal $personal, array $data)
    {
        //$tag->user_id = $data['user_id'];
        $personal->name       = e($data['name']);
        $personal->slug        = Str::slug($data['name'], '-');
        $personal->titulo = $data['titulo'];
        $personal->cedula = $data['cedula'];
        $personal->email = $data['email'];
        

        $personal->save();

        //$tag->tags()->sync($data['tags']);
        //$tag->ciudades()->sync($data['ciudades']);
        //$tag->categories()->sync($data['categories']);

        return $personal;
    }

    /**
     * Update the specified tag in the database.
     *
     * @param  mixed  $id
     * @param  array  $data
     * @return \Tricks\Category
     */
    public function update($id, array $data)
    {
        $personal = $this->findById($id);

        $personal->name = $data['name'];
        $personal->slug = Str::slug($personal->name, '-');
        $personal->titulo = $data['titulo'];
        $personal->cedula = $data['cedula'];
        $personal->email = $data['email'];

        $personal->save();

        return $personal;
    }

    /**
     * Delete the specified tag from the database.
     *
     * @param  mixed  $id
     * @return void
     */
    public function delete($id)
    {
        $personal = $this->findById($id);

        $personal->tricks()->detach();

        $personal->delete();
    }

    /**
     * Get the tag create/update form service.
     *
     * @return \Tricks\Services\Forms\TagForm
     */
    public function getForm()
    {
        return new PersonalForm;
    }
    /**
     * Get the tag creation form service.
     *
     * @return \Tricks\Services\Forms\TrickForm
     */
    public function getCreationForm()
    {
        return new PersonalForm;
    }

    /**
     * Get the tag edit form service.
     *
     * @return \Tricks\Services\Forms\TagEditForm
     */
    public function getEditForm($id)
    {
        return new PersonalEditForm($id);
    }
}
