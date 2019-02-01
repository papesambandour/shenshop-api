<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public $timestamps =  false ;
    protected $guarded = [];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'categories_id','id');
    }

    public function commandes(){
        return $this->hasMany(Commande::class,'produits_id','id');
    }

}