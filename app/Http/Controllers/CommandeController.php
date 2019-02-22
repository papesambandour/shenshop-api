<?php

namespace App\Http\Controllers;

use App\Commande;
use App\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use JWTAuth;

class CommandeController extends Controller
{

    /**
     * CommandeController constructor.
     */
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    public function savecommande(Request $request)
    {
       // dd($request->all());
        $user = JWTAuth::authenticate();
        $product = Produit::findorFail(Input::get("produits_id"));
        $commande  = new Commande();
        $commande->amount = $product->price * (float)Input::get("quantity");
        $commande->quantity = (float)Input::get("quantity");
        $commande->name = "Commande de " . $product->name;
        $commande->ref = uniqid("SS-");
        $commande->state = "success";
        $commande->mode_payment = "on_shipping";
        $commande->produits_id = $product->id;
        $commande->users_id = $user->id;
        $commande->validate_date = (new \DateTime())->format("Y-m-d H:i:s");
        $commande->save();
        $product->stock = $product->stock - (int)Input::get("quantity");
        $product->save();
        return $commande ;

    }
    public function getCommande($id)
    {
        return Commande::with('produit')->get()->find($id) ;
    }
    public function allcommande()
    {
        $id = JWTAuth::authenticate()->id;
        return Commande::where('users_id',$id)->get();
    }
}
