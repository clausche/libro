<?php

namespace Tricks\Repositories;
use Tricks\User;
use Tricks\Trick;
use Tricks\Tag;
use Tricks\Personal;

interface PersonalRepositoryInterface
{
    /**
     * Get an array of key-value (id => name) pairs of all tags.
     *
     * @return array
     */
    public function listAll();

    /**
     * Find all tags.
     *
     * @param  string $orderColumn
     * @param  string $orderDir
     * @return \Illuminate\Database\Eloquent\Collection|\Tricks\Tag[]
     */
    public function findAll($orderColumn = 'created_at', $orderDir = 'desc');

    /**
     * Find a tag by id.
     *
     * @param  mixed $id
     * @return \Tricks\Tag
     */
    public function findById($id);
    
    public function findBySlug($slug);

    /**
     * Find all tags with the associated number of tricks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAllWithTrickCount();

    /**
     * Get a list of tag ids that are associated with the given trick.
     *
     * @param  \Tricks\Trick $tags
     * @return array
     */
    public function listPersonalesIdsForTrick(Personal $personales);

    /**
     * Update the trick in the database.
     *
     * @param  \Tricks\Trick $trick
     * @param  array $data
     * @return \Tricks\Trick
     */
    public function edit(Personal $personales, array $data);

    /**
     * Create a new tag in the database.
     *
     * @param  array $data
     * @return \Tricks\Tag
     */
    public function create(array $data);

    /**
     * Update the specified tag in the database.
     *
     * @param  mixed $id
     * @param  array $data
     * @return \Tricks\Category
     */
    public function update($id, array $data);

    /**
     * Delete the specified tag from the database.
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id);
}
