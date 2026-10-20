<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;

class ContatoController extends Controller
{
    //GET
    public function index()
    {
        //Model pega os dados do banco e traz
        $contatos = Contato::all();
        //Retorna os dados em formato JSON
        // return response()->json($contatos);

        //Envia valores para a view
        return view('contatos',['contatos' => $contatos]);

    }

    //POST

    /**
     * POST - Cadastra um novo contato.
     */
    public function form(Request $request)
    {
        // 1. Valida os dados enviados pelo formulário
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'telefone' => 'required|string',
            'email' => 'required|email',
            'endereco' => 'required|string',
        ], [
            // Mensagens personalizadas de validação
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'telefone.required' => 'O telefone é obrigatório.',
            'endereco.required' => 'O endereço é obrigatório.',
        ]);

        // 2. Cria um novo objeto Contato
        $contato = new Contato();

        // 3. Recebe os dados do formulário
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->endereco = $request->input('endereco');

        // 4. Salva no banco somente se os dados forem válidos
        $contato->save();

        // 5. Retorna com mensagem de sucesso
        return redirect('/')
         ->with('sucesso', 'Contato cadastrado com sucesso!');
    }


    public function edit($id)
    {
        //Busca o contato pelo id
        $contato = Contato::find($id);

        //Abre a view de edição com o registro buscado
        return view('edit', ['contato' => $contato]);
    }


    /**
     * PUT - Atualiza um contato existente.
     */
    public function update(Request $request, $id)
    {
        // 1. Valida os dados recebidos
        $request->validate([
            'nome' => 'required|string|min:3|max:255',
            'telefone' => 'required|string',
            'email' => 'required|email',
            'endereco' => 'required|string',
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos 3 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Digite um e-mail válido.',
            'telefone.required' => 'O telefone é obrigatório.',
            'endereco.required' => 'O endereço é obrigatório.',
        ]);

        // 2. Busca o contato no banco pelo ID
        $contato = Contato::findOrFail($id);

        // 3. Atualiza os dados
        $contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->endereco = $request->input('endereco');

        // 4. Salva as alterações
        $contato->save();

        // 5. Retorna com mensagem de sucesso
        return redirect('/')
            ->with('sucesso', 'Contato atualizado com sucesso!');
    }


    /**
     * DELETE - Exclui um contato do banco de dados.
     */
    public function delete($id)
    {
        // Busca o contato pelo ID informado
        $contato = Contato::find($id);

        // Verifica se o contato existe
        if ($contato) {

            // Exclui o contato do banco de dados
            $contato->delete();

            // Retorna para a página principal
            // com uma mensagem de sucesso
            return redirect('/')->with(
                'sucesso',
                'Contato excluído com sucesso!'
            );
        }

        // Caso o contato não seja encontrado
        return redirect('/')->with(
            'erro',
            'Contato não encontrado!'
        );
    }

}



