
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Contatos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f1f5f9;
            font-family: 'Segoe UI', sans-serif;
            color: #334155;
        }

        .navbar {
            background: #0f172a;
            padding: 20px 0;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 22px;
        }

        .page-title {
            font-weight: 700;
            color: #0f172a;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 22px;
            font-weight: 600;
            border-radius: 16px 16px 0 0 !important;
        }

        .card-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 9px;
            padding: 12px;
            border: 1px solid #cbd5e1;
        }

        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16,185,129,0.12);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }

        .btn-success {
            background: #059669;
            border: none;
            padding: 12px 25px;
            border-radius: 9px;
            font-weight: 600;
        }

        .btn-success:hover {
            background: #047857;
        }

        .table thead {
            background: #f8fafc;
        }

        .table th {
            color: #64748b;
            font-size: 13px;
            text-transform: uppercase;
            padding: 16px;
        }

        .table td {
            padding: 16px;
            vertical-align: middle;
        }

        .avatar {
            background: #d1fae5;
            color: #047857;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }


        /* Aparência da janela de edição */
        .modal-edicao {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        /* Cabeçalho */
        .modal-edicao .modal-header {
            background: #ffffff;
            padding: 22px 25px;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Título */
        .modal-edicao .modal-title {
            font-weight: 600;
            color: #0f172a;
        }

        /* Área dos campos */
        .modal-edicao .modal-body {
            padding: 25px;
        }

        /* Rodapé */
        .modal-edicao .modal-footer {
            padding: 18px 25px;
            border-top: 1px solid #e2e8f0;
        }

        /* Escurecimento da tela principal */
        .modal-backdrop.show {
            opacity: 0.65;
        }

    </style>
</head>

<body>

    <!-- Barra superior -->
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-person-lines-fill me-2"></i>
                Menager de Contatos
            </a>
        </div>
    </nav>

    <main class="container py-5">

            <!-- Área das notificações flutuantes -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3"
                style="z-index: 1100;">

                <!-- Notificação de sucesso -->
                @if(session('sucesso'))

                    <div class="toast align-items-center text-white bg-success border-0"
                        role="status"
                        aria-live="polite"
                        aria-atomic="true"
                        data-bs-delay="2000"
                        data-bs-autohide="true">

                        <div class="d-flex">

                            <div class="toast-body">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                {{ session('sucesso') }}
                            </div>

                            <!-- Botão para fechar -->
                            <button type="button"
                                    class="btn-close btn-close-white me-2 m-auto"
                                    data-bs-dismiss="toast"
                                    aria-label="Fechar">
                            </button>

                        </div>
                    </div>

                @endif

                <!-- Notificação de erro -->
                @if(session('erro'))

                    <div class="toast align-items-center text-white bg-danger border-0"
                        role="alert"
                        aria-live="assertive"
                        aria-atomic="true"
                        data-bs-delay="2000"
                        data-bs-autohide="true">

                        <div class="d-flex">

                            <div class="toast-body">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                {{ session('erro') }}
                            </div>

                            <button type="button"
                                    class="btn-close btn-close-white me-2 m-auto"
                                    data-bs-dismiss="toast"
                                    aria-label="Fechar">
                            </button>

                        </div>
                    </div>

                @endif

                <!-- Notificação de erros de validação -->
                @if($errors->any())

                    <div class="toast align-items-center text-white bg-danger border-0"
                        role="alert"
                        aria-live="assertive"
                        aria-atomic="true">

                        <div class="d-flex">

                            <div class="toast-body">

                                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                                <!-- Percorre os erros encontrados -->
                                @foreach($errors->all() as $erro)
                                    <div>{{ $erro }}</div>
                                @endforeach

                            </div>

                            <!-- Botão para fechar -->
                            <button type="button"
                                    class="btn-close btn-close-white me-2 m-auto"
                                    data-bs-dismiss="toast"
                                    aria-label="Fechar">
                            </button>

                        </div>
                    </div>

                @endif


            </div>

            {{-- faixa de cima --}}
            <div class="mb-4">
                <h2 class="page-title">Gerenciamento de Contatos</h2>
                <p class="text-muted">
                    Cadastre e visualize seus contatos em um só lugar.
                </p>
            </div>

            <!-- Formulário -->
            <div class="card mb-5">
                <div class="card-header">
                    <i class="bi bi-person-plus me-2 text-success"></i>
                    Novo Contato
                </div>

                <div class="card-body">
                    <form action="{{ url('/save') }}" method="POST" novalidate>
                        @csrf

                        <div class="row g-4">

                            <div class="col-md-6">
                                <label for="nome" class="form-label">
                                    Nome completo
                                </label>
                                <input type="text"
                                    class="form-control"
                                    id="nome"
                                    name="nome"
                                    value="{{ old('nome') }}"
                                    placeholder="Digite o nome"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label for="telefone" class="form-label">
                                    Telefone
                                </label>
                                <input type="tel"
                                    class="form-control"
                                    id="telefone"
                                    name="telefone"
                                    value ="{{ old('telefone') }}"
                                    placeholder="(41) 99999-9999"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    E-mail
                                </label>
                                <input type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="exemplo@email.com"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label for="endereco" class="form-label">
                                    Endereço
                                </label>
                                <input type="text"
                                    class="form-control"
                                    id="endereco"
                                    name="endereco"
                                    value="{{ old('endereco') }}"
                                    placeholder="Rua, número e bairro"
                                    required>
                            </div>

                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-2"></i>
                                Salvar Contato
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Lista de contatos -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>
                        <i class="bi bi-people me-2 text-success"></i>
                        Contatos Cadastrados
                    </span>

                    <span class="badge bg-success">
                        {{ count($contatos) }} contatos
                    </span>
                </div>

                <!-- Formulário de pesquisa de contatos -->
                <div class="px-4 pt-4 pb-3">

                    <!-- GET: envia a pesquisa pela URL -->
                    <form action="{{ url('/') }}" method="GET">

                        <div class="input-group">

                            <!-- Campo de pesquisa em tempo real -->
                            <input type="text"
                                id="pesquisaContato"
                                name="busca"
                                class="form-control"
                                placeholder="Pesquisar contato pelo nome..."
                                autocomplete="off">

                            <!-- Limpa a pesquisa sem atualizar a página -->
                            <button type="button"
                                    class="btn btn-outline-secondary"
                                    id="limparPesquisa">

                                <i class="bi bi-x-circle me-1"></i>
                                Limpar

                            </button>

                        </div>

                    </form>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>E-mail</th>
                                    <th>Endereço</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($contatos as $c)
                                <tr class="linha-contato"
                                    data-nome="{{ $c->nome }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="avatar">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <strong>{{ $c->nome }}</strong>
                                        </div>
                                    </td>

                                    <td>{{ $c->telefone }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>{{ $c->endereco }}</td>
                                    <!-- Botões de ações -->
                        <td>
                            <div class="d-flex justify-content-center gap-2">

                            <!-- Botão que abre a janela de detalhes -->
                            <button type="submit"
                                    class="btn btn-info btn-sm text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDetalhes{{ $c->id }}">

                                <i class="bi bi-eye me-1"></i>
                                Ver Detalhes

                            </button>

                            <!-- Botão que abre a janela de edição -->
                            <button type="button"
                                    class="btn btn-secondary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditar{{ $c->id }}">

                                <i class="bi bi-pencil-square"></i>
                                Editar

                            </button>
                                </form>

                                <!-- Excluir -->
                                <form action="{{ url('/delete/' . $c->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Deseja realmente excluir este contato?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                        Excluir
                                    </button>
                                </form>

                            </div>
                        </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">

                                        <i class="bi bi-search fs-4 d-block mb-2"></i>

                                        @if(request('busca'))
                                            Nenhum contato encontrado para
                                            <strong>{{ request('busca') }}</strong>.
                                        @else
                                            Nenhum contato cadastrado.
                                        @endif

                                    </td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!-- Percorre os contatos para criar uma janela de edição para cada um -->
            @foreach ($contatos as $c)

            <div class="modal fade"
                id="modalEditar{{ $c->id }}"
                tabindex="-1"
                aria-labelledby="tituloEditar{{ $c->id }}"
                aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content modal-edicao">

                        <!-- Cabeçalho da janela -->
                        <div class="modal-header">

                            <h5 class="modal-title"
                                id="tituloEditar{{ $c->id }}">

                                <i class="bi bi-pencil-square text-success me-2"></i>
                                Editar Contato
                            </h5>

                            <!-- Botão para fechar a janela -->
                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Fechar">
                            </button>

                        </div>

                        <!-- Formulário de edição -->
                        <form action="{{ url('/update/' . $c->id) }}"
                            method="POST" novalidate>

                            <!-- Proteção de segurança do Laravel -->
                            @csrf

                            <!-- Define que a requisição é PUT -->
                            @method('PUT')

                            <div class="modal-body">

                                <p class="text-muted mb-4">
                                    Atualize as informações do contato.
                                </p>

                                <!-- Campo Nome -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        Nome completo
                                    </label>

                                    <input type="text"
                                        name="nome"
                                        class="form-control"
                                        value="{{ $c->nome }}"
                                        required>
                                </div>

                                <!-- Campo Telefone -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        Telefone
                                    </label>

                                    <input type="tel"
                                        name="telefone"
                                        class="form-control"
                                        value="{{ $c->telefone }}"
                                        required>
                                </div>

                                <!-- Campo E-mail -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        E-mail
                                    </label>

                                    <input type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ $c->email }}"
                                        required>
                                </div>

                                <!-- Campo Endereço -->
                                <div class="mb-3">
                                    <label class="form-label">
                                        Endereço
                                    </label>

                                    <input type="text"
                                        name="endereco"
                                        class="form-control"
                                        value="{{ $c->endereco }}"
                                        required>
                                </div>

                            </div>

                            <!-- Rodapé com botões -->
                            <div class="modal-footer">

                                <!-- Fecha sem salvar -->
                                <button type="button"
                                        class="btn btn-light"
                                        data-bs-dismiss="modal">
                                    Cancelar
                                </button>

                                <!-- Envia as alterações ao Laravel -->
                                <button type="submit"
                                        class="btn btn-success">

                                    <i class="bi bi-check-circle me-1"></i>
                                    Salvar Alterações
                                </button>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

            @endforeach

            <!-- Abre janela de detalhes para cada contato -->
            @foreach ($contatos as $c)

            <div class="modal fade"
                id="modalDetalhes{{ $c->id }}"
                tabindex="-1"
                aria-labelledby="tituloDetalhes{{ $c->id }}"
                aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content modal-edicao">

                        <!-- Cabeçalho -->
                        <div class="modal-header">

                            <h5 class="modal-title"
                                id="tituloDetalhes{{ $c->id }}">

                                <i class="bi bi-eye text-success me-2"></i>
                                Detalhes do Contato

                            </h5>

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Fechar">
                            </button>

                        </div>

                        <!-- Informações do contato -->
                        <div class="modal-body">

                            <!-- Nome -->
                            <div class="mb-4">

                                <label class="form-label text-muted">
                                    <i class="bi bi-person text-success me-2"></i>
                                    Nome completo
                                </label>

                                <div class="fw-semibold">
                                    {{ $c->nome }}
                                </div>

                            </div>

                            <hr>

                            <!-- Telefone -->
                            <div class="mb-4">

                                <label class="form-label text-muted">
                                    <i class="bi bi-telephone text-success me-2"></i>
                                    Telefone
                                </label>

                                <div>
                                    {{ $c->telefone }}
                                </div>

                            </div>

                            <hr>

                            <!-- E-mail -->
                            <div class="mb-4">

                                <label class="form-label text-muted">
                                    <i class="bi bi-envelope text-success me-2"></i>
                                    E-mail
                                </label>

                                <div class="text-break">
                                    {{ $c->email }}
                                </div>

                            </div>

                            <hr>

                            <!-- Endereço -->
                            <div class="mb-3">

                                <label class="form-label text-muted">
                                    <i class="bi bi-geo-alt text-success me-2"></i>
                                    Endereço
                                </label>

                                <div class="text-break">
                                    {{ $c->endereco }}
                                </div>

                            </div>

                        </div>

                        <!-- Rodapé -->
                        <div class="modal-footer">

                            <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">

                                <i class="bi bi-x-circle me-1"></i>
                                Fechar

                            </button>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach


    </main>

    <!-- JavaScript do Bootstrap 5 -->
    <!-- Responsável por abrir e fechar as janelas modais -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Inicialização automática das notificações -->
    <script>
        // Aguarda o carregamento da página
        document.addEventListener('DOMContentLoaded', function () {

            // Localiza todas as notificações Toast
            const notificacoes = document.querySelectorAll('.toast');

            // Percorre cada notificação encontrada
            notificacoes.forEach(function (elemento) {

                // Cria uma instância do Toast do Bootstrap
                const toast = new bootstrap.Toast(elemento, {
                    autohide: true,
                    delay: 2000
                });

                // Exibe a notificação automaticamente
                toast.show();
            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Campo onde o usuário digita a pesquisa
            const pesquisa = document.getElementById('pesquisaContato');

            // Todas as linhas de contatos da tabela
            const linhas = document.querySelectorAll('.linha-contato');

            // Botão para limpar a pesquisa
            const limpar = document.getElementById('limparPesquisa');

            // Executa a pesquisa em tempo real
            function filtrarContatos() {

                // Obtém o texto digitado
                const texto = pesquisa.value.toLowerCase().trim();

                // Percorre os contatos cadastrados
                linhas.forEach(function (linha) {

                    // Obtém o nome do contato
                    const nome = linha.dataset.nome.toLowerCase();

                    // Verifica se o nome contém o texto pesquisado
                    const encontrado = nome.includes(texto);

                    // Exibe ou oculta a linha
                    linha.style.display = encontrado ? '' : 'none';

                });
            }

            // Executa a função a cada letra digitada
            pesquisa.addEventListener('input', filtrarContatos);

            // Limpa a pesquisa e mostra todos os contatos
            limpar.addEventListener('click', function () {

                pesquisa.value = '';

                filtrarContatos();

                pesquisa.focus();

            });

        });
    </script>



</body>
</html>
