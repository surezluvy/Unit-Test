<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'is_done'];

    public function toggleStatus(){
        if($this->is_done == 0){
            $this->is_done = 1;
        } else{
            $this->is_done = 0;
        }

        $this->save();
    }
}
