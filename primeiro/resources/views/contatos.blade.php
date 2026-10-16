<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
        <form action="{{url('/save') }}" method="POST">
        @csrf <!-- Adicione o token CSRF para segurança -->
        <div class="container-sm">
                <div class="shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="d-flex flex-column bd-highlight mb-3">
                <div class="p-2 bd-highlight">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nome" aria-label="Nome" name="nome" id="nome" required><br>
                            </div>
                        </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Telefone" aria-label="Telefone" name="telefone" id="telefone" required><br>
                        </div>
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Email" aria-label="Email" name="email" id="email" required><br>
                        </div>
                    </div>

                </div>
                </div>
                <div class="p-2 bd-highlight">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Endereço" aria-label="Endereço" name="endereco" id="endereco" required><br>
                        </div>
                    </div>
                </div>
            </div>


                <button type="submit" class="btn btn-success">Salvar Contato</button>
        </div>

    </form>

    <hr>
    <div class="p-3 mb-2 bg-secondary text-white">
            <h2> Contatos Salvos no Banco de Dados </h2>
        <ul>
            @foreach ($contatos as $c)
            <li><strong>{{$c->nome}}</strong> - {{$c->telefone}} | {{$c->email}} | {{$c->endereco}}</li>
            @endforeach
        </ul>
    </div>

</body>
