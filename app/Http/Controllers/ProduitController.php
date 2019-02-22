<?php

namespace App\Http\Controllers;

use App\Product;
use App\Produit;
use Illuminate\Http\Request;
use JWTAuth;

class ProduitController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function allproduits()
    {
        return Produit::with('categorie')->get();
    }

    public function getProtuit($id)
    {
        return Produit::with('categorie')->get()->find($id);
       // return Produit::with('categorie')->get()->find($id);
    }


}
