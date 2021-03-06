<?php

namespace Tricks\Services\Forms;

class TrickForm extends AbstractForm
{
    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'title'         => 'required|min:4|unique:tricks,title',
        'description'   => 'required|min:10',
        'tags'          => 'required',
        'categories'    => 'required',
        'ciudades'      => 'required'
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
            'title', 
            'description', 
            'tags', 
            'categories',
            'ciudades',
            'personales',
            'emb_direccion',
            'emb_tlf',
            'emb_fax',
            'emb_email',
            'emb_web',
            'emb_hora'
        ]);
    }
}
