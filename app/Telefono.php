<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Telefono extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'telspamarcar';
    protected $table = 'telspamarcar';
    public $timestamps = false;
}