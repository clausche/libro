<?php

namespace Tricks\Services\Forms;

class PersonalEditForm extends AbstractForm
{
    /**
     * The id of the trick.
     *
     * @var mixed
     */
    protected $id;

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'name'         => 'required|min:4|unique:personales,name',
        'titulo'         => 'required|min:4'
        //'ciudades'      => 'required'
        //'code'          => 'required'

    ];

    public function __construct($id)
    {
        parent::__construct();

        $this->id = $id;
    }

    /**
     * Get the prepared validation rules.
     *
     * @return array
     */
    protected function getPreparedRules()
    {
        $this->rules['name'] .= ',' . $this->id;

        return $this->rules;
    }

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'name', 'titulo'
            //, 'code'
            //'ciudades'

            ]);
    }
}
