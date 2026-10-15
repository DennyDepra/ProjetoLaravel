<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Lista de Contatos</title>
</head>
<body>
    <form action="{{url('/save')}}" method="POST">
        @csrf <!-- Adicione o token CSRF para segurança -->
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" id="telefone" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="endereco">Endereço:</label>
        <input type="text" name="endereco" id="endereco" required><br>

        <button type="submit">Salvar Contato</button>
</body>
