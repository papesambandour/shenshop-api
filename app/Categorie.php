<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public $timestamps =  false ;
    protected $guarded = [];
    protected $hidden = ['updated_at','created_at'];

    public function produits(){
        return $this->hasMany(Produit::class,'categories_id','id');
    }
}
