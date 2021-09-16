<?php

namespace App\Http\Controllers;

use App\Models\MyPokemonList;
use Illuminate\Http\Request;

class ListPokemonController extends Controller
{
    public function index()
    {
        return view('list-pokemon');
    }

    public function pokemonDetail($id)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://pokeapi.co/api/v2/pokemon/'.$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $details = json_decode($response);
            return view('pokemon-detail', compact('details'));

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function savePokemon(Request $request)
    {
        try {
            $data = $request->all();
            MyPokemonList::create($data);
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menangkap pokemon ' . $data['name']
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function myListPokemon()
    {
        try {
            $mylistPokemon = MyPokemonList::all();
            return view('my-list-pokemon', compact('mylistPokemon'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteMyListPokemon($id)
    {
        try {
            $pokemon = MyPokemonList::findOrFail($id);
            $pokemon->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
