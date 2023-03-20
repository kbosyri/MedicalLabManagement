<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestsGroup extends Model
{
    use HasFactory;

    public function tests()
    {
        return $this->belongsToMany(Test::class,'test_group_tests','tests_group_id','test_id');
    }
}
