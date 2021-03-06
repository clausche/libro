<?php

namespace Tricks\Services\Forms;

class PersonalForm extends AbstractForm
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'name'         => 'required|unique:personales,name',
        'titulo'   => 'required|min:4'
        
        //'spanish_name' => 'required'
        //'categories'    => 'required',
        //'ciudades'      => 'required'
        //'code'          => 'required'
    ];

    /**
     * Get the prepared input data.
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'name', 'titulo','cedula','email'//, 'code'
            
        ]);
    }
}