<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Debug\FatalErrorHandler\UndefinedFunctionFatalErrorHandler;

class Commande extends Model
{
    public $timestamps =  false ;
    protected $guarded = [];
    protected $hidden = ['updated_at','created_at'];
    public function produit()
    {
        return $this->belongsTo(Produit::class,'produits_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
