<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Exibe a lista de usuários.
     */
    public function index()
    {
        $user = auth()->user(); // Obtém o usuário autenticado

        if ($user->nivel_id == 1) {
            // Se for nível 1, exibe todos os usuários
            $users = User::with('nivel')->get();
        } else {
            // Caso contrário, exibe apenas os dados do próprio usuário
            $users = User::with('nivel')->where('id', $user->id)->get();
        }

        return view('users.index', compact('users'));
    }

    /**
     * Armazena um novo usuário no banco de dados.*/
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
//            'contato' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um usuário específico.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Exibe o formulário de edição de um usuário.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Atualiza os dados de um usuário.
     */
    public function update(Request $request, User $user)
    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|email|unique:users,email,' . $user->id,
//            'password' => 'nullable|string|min:6|confirmed', // Certifique-se que "password_confirmation" seja enviado no request
//            'nivel_id' => 'nullable|integer|exists:nivel,id',  // Validação para nivel_id, ajustando conforme necessário
//        ]);

        // Atualiza os dados do usuário
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'data_nascimento' => $request->data_nascimento,
            'contato' => $request->contato,
            'endereco' => $request->endereco,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'nivel_id' => $request->nivel_id,  // Atualiza o nivel_id com o valor do request
        ]);

        // Log para ajudar na depuração
        Log::info('Usuário atualizado: ' . $user->id);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }


    /**
     * Remove um usuário do banco de dados.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }

}
