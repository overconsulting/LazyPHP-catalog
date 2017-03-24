<?php

namespace Catalog\models;

use System\Model;
use System\Query;
use System\Password;

class Product extends Model
{
    protected $permittedColumns = array(
        'category_id',
        'name',
        'description',
        'price',
        'active'
    );

    /**
     * Set default properties values
     */
    public function setDefaultProperties()
    {
        parent::setDefaultProperties();

        $this->category_id = null;
        $this->price = 0.0;
        $this->active = 1;
    }

    /**
     * Validate the object and fill $this->errors with error messages
     *
     * @return bool
     */
    public function valid()
    {
        $this->errors = array();

        if (!isset($this->category_id) || $this->category_id == '') {
            $this->category_id = null;
        }

        $this->name = trim($this->name);
        if ($this->name == '') {
            $this->errors['name'] = 'Nom obligatoire';
        }

        if (!isset($this->price) || $this->price == '') {
            $this->price = 0.0;
        }

        return empty($this->errors);
    }
}
