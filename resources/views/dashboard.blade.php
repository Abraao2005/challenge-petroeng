<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de Colaborador</title>
    <link rel="stylesheet" href="{{ asset('css/output.css') }}">
</head>

<body class="bg-slate-500">

    <div>
        <header class="bg-slate-400 w-auto h-20 flex items-center justify-center">
            <h1 class="text-white text-2xl font-bold">Cadastro de Colaborador</h1>
        </header>

        <div class="container mx-auto mt-8 p-4 bg-white rounded shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">Cadastrar Colaborador</h2>
                <button id="toggleForm" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Adicionar Colaborador
                </button>
            </div>

            @if (session('success'))
                <div class="bg-green-500 text-white p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="colaboradorForm" action="{{ route('cadastrar') }}" method="POST" class="space-y-4 hidden">
                @csrf

                <div>
                    <label for="nome" class="block font-medium">Nome do Colaborador</label>
                    <input type="text" id="nome" name="nome" class="w-full border rounded p-2" required>
                </div>

                <div>
                    <label for="departamento" class="block font-medium">Departamento</label>
                    <select id="departamento" name="departamento" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Selecione um departamento</option>
                        @foreach ($departamentos as $departamento)
                            <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="setor" class="block font-medium">Setor</label>
                    <select id="setor" name="setor" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Selecione um setor</option>
                        @foreach ($setores as $setor)
                            <option value="{{ $setor->id }}" data-departamento="{{ $setor->departamento_id }}">
                                {{ $setor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Salvar
                    </button>
                </div>
            </form>
        </div>

        <div class="container mx-auto mt-8 p-4 bg-white rounded shadow-md">
            <h2 class="text-lg font-bold mb-4">Colaboradores</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2">Nome</th>
                        <th class="border border-gray-300 p-2">Departamento</th>
                        <th class="border border-gray-300 p-2">Setor</th>
                        <th class="border border-gray-300 p-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($colaboradores as $colaborador)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $colaborador->name }}</td>
                            <td class="border border-gray-300 p-2">
                                {{ $departamentos[$colaborador->departamento_id]->name }}</td>
                            <td class="border border-gray-300 p-2">{{ $setores[$colaborador->setor_id - 1]->name }}
                            </td>
                            <td class="border border-gray-300 p-2 text-center">
                                <!-- Botão Editar -->
                                <button class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600"
                                    onclick="openEditForm({{ $colaborador->id }})">
                                    Editar
                                </button>

                                <!-- Botão Excluir -->
                                <form action="{{ route('delete', $colaborador->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                        Excluir
                                    </button>
                                </form>
                             
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
   <!-- Formulário de Edição (inicialmente escondido) -->
   <div id="editForm"
   class="hidden container mx-auto mt-8 p-4 bg-white rounded shadow-md">
   <h2 class="text-lg font-bold">Editar Colaborador</h2>
   <form id="editColaboradorForm" method="POST" class="space-y-4">
       @csrf
       @method('PUT') <!-- Método PUT para atualização -->

       <div>
           <label for="editNome" class="block font-medium">Nome do Colaborador</label>
           <input type="text" id="editNome" name="nome" class="w-full border rounded p-2" required>
       </div>

       <div>
           <label for="editDepartamento" class="block font-medium">Departamento</label>
           <select id="editDepartamento" name="departamento" class="w-full border rounded p-2" required>
               <option value="" disabled selected>Selecione um departamento</option>
               @foreach ($departamentos as $departamento)
                   <option value="{{ $departamento->id }}">{{ $departamento->name }}</option>
               @endforeach
           </select>
       </div>

       <div>
           <label for="editSetor" class="block font-medium">Setor</label>
           <select id="editSetor" name="setor" class="w-full border rounded p-2" required>
               <option value="" disabled selected>Selecione um setor</option>
               @foreach ($setores as $setor)
                   <option value="{{ $setor->id }}" data-departamento="{{ $setor->departamento_id }}">
                       {{ $setor->name }}
                   </option>
               @endforeach
           </select>
       </div>

       <div>
           <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
               Atualizar
           </button>
       </div>
   </form>
</div>
    <script>
        function openEditForm(colaboradorId) {
            const colaborador = @json($colaboradores); // Dados dos colaboradores
            const colaboradorData = colaborador.find(col => col.id === colaboradorId); // Encontrar o colaborador pelo ID

            // Preencher os campos do formulário com os dados do colaborador
            document.getElementById('editNome').value = colaboradorData.name;
            document.getElementById('editDepartamento').value = colaboradorData.departamento_id;
            document.getElementById('editSetor').value = colaboradorData.setor_id;

            // Atualizar a URL de ação do formulário para incluir o ID do colaborador
            const editForm = document.getElementById('editColaboradorForm');
            editForm.action = `{{ url('/atualizar') }}/${colaboradorId}`; // A URL será dinamicamente atualizada com o ID

            // Exibir o formulário de edição
            document.getElementById('editForm').classList.remove('hidden');
        }

        // Exibir/ocultar o formulário de cadastro
        document.getElementById('toggleForm').addEventListener('click', function() {
            const form = document.getElementById('colaboradorForm');
            form.classList.toggle('hidden');
        });

        // Filtro de setores com base no departamento selecionado
        const departamentoSelect = document.getElementById('departamento');
        const setorSelect = document.getElementById('setor');
        departamentoSelect.addEventListener('change', function() {
            const selectedDepartamento = this.value;
            Array.from(setorSelect.options).forEach(option => {
                option.style.display = option.getAttribute('data-departamento') === selectedDepartamento ?
                    '' : 'none';
            });
            setorSelect.value = "";
        });
    </script>

</body>

</html>
