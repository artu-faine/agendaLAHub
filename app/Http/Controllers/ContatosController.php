<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contato;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ContatosController extends Controller
{
    public function index() {

        $search = request("search");

        if($search) {
            $contatos = Contato::where(
                'nome', 'like', '%' . $search . '%'
            )->get();
        } else {
        $contatos = Contato::all();
        }
        
        $contatosOwner = User::all();

        return view('welcome', ['contatos' => $contatos, 'contatosOwner' => $contatosOwner, 'search' => $search]);
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        $contatos = new Contato;

        // Validações:
        $request->validate([
            'nome' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'min:9'],
        ], [
            'nome.required' => 'O campo "nome" é obrigatório!',
            'nome.min' => 'O campo "nome" deve ter no mínimo 3 caracteres.',
            'phone.required' => 'O campo "telefone" é obrigatório!',
            'phone.min' => 'O campo "telefone" deve ter no mínimo 9 caracteres',
        ]
    );

        $contatos->nome = $request->nome;
        $contatos->phone = $request->phone;

        $user = auth()->user();
        $contatos->user_id = $user->id;

        $contatos->save();

        return redirect('/')->with('msg', 'Contato criado!')->with('status', 'success');
    }

    public function edit($id) {

        $user = auth()->user();

        $contato = Contato::findOrFail($id);

        if(isset($user->name) == false) {
            return redirect('login')->with('msg', 'Você não pode editar um contato sem estar autenticado! Por favor faça o login.')->with('status','danger');
        } elseif ($contato->user_id != $user->id) {

            // $err = 'Você não pode editar um contato que não te pertence!';

            // $contatos = [];

            return redirect('/')->with('msg', 'Você não pode editar um contato que não te pertence!')->with('status', 'danger');
        } else {
            return view('edit', ['contato' => $contato]);
        }
    }

    public function update(Request $request) {

        $request->validate([
            'nome' => ['required', 'string', 'min:3'],

            'phone' => ['required', 'min:3'],
        ], [
            'nome.required' => 'O campo "nome" é obrigatório!',
            'nome.min' => 'O campo "nome" deve ter no mínimo 3 caracteres.',
            'phone.required' => 'O campo "telefone" é obrigatório!',
            'phone.min' => 'O campo "telefone" deve ter no mínimo 3 caracteres',
        ]
    );

        $data = $request->all();

        Contato::findOrFail($request->id)->update($data);

        return redirect('/')->with('msg', 'Contato atualizado!')->with('status', 'success');
    }

    public function delete($id){

        $contato = Contato::findOrFail($id);

        $user = auth()->user();

        if(isset($user->name) == false) {
            return redirect('login')->with('msg', 'Você não pode deletar um contato sem se autenticar! Faça o login.')->with('status', 'danger');
        }

        if ($user->id != $contato->user_id) {

            return redirect('/')->with('msg', 'Você não pode deletar um contato que não te pertence!')->with('status', 'danger');
        }

        Contato::findOrFail($id)->delete();

        return redirect('/')->with('msg', 'Contato deletado!')->with('status', 'success');
    }

    public function aut(Request $request) {

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    } else {
        return redirect()->back()->with('msg', 'Email ou senha não encontrados.')->with('status', 'danger');
    }
}

    public function autLink(){
        return view('auth.login');
    }

    public function dashboard() {
        return view('meuDashboard');
    }

    public function Ind() {

        // $contatos = Contato::all();


        // $contatos = Contato::all();

        // $contato = Contato::find(1);

        // $usuario = $contato->user;

        $usuario = auth()->user();

        $contatos = $usuario->contatos;

        return view('contatosInd', ['contatos' => $contatos, 'usuario' => $usuario]);
    }
}