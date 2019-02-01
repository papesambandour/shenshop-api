<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $timestamps =  false ;
    protected $guarded = [];

    public function produits(){
        return $this->hasMany(Produit::class,'categories_id','id');
    }
}
