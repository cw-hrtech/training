<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function getAllStudent($perPage = 10)
    {
        return $this->paginate($perPage);
    }
}
