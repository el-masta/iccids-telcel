<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Iccid extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'ICC';
    protected $table = 'ICC';
    public $timestamps = false;
}