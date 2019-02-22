<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public $timestamps =  false ;
    protected $hidden = ['updated_at','created_at'];
    protected $guarded = ["created_at","updated_at","categories_id"];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class,'categories_id','id');
    }

    public function commandes(){
        return $this->hasMany(Commande::class,'produits_id','id');
    }

}
