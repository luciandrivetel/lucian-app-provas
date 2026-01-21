<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Rêferencia</th>
            <th>Data</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        @forelse($proofs as $proof)
            <tr>
                <td>{{ $proof->nome }}</td>
                <td>{{ $proof->referencia }}</td>
                <td>{{ $proof->created_at }}</td>
                <td>
                    <form action="{{ route('proofs.edit', $proof->id) }}" method="GET" style="display:inline">
                        @csrf
                        <button type="submit" style="color:green">Editar</button>
                    </form>
                    <form action="{{ route('proofs.delete', $proof->id) }}" method="POST" style="display: inline" onsubmit="return confirm('Tem certeza que deseja apagar?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:red">Apagar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="color: red">Nenhuma prova encontrada</td>
            </tr>
        @endforelse
    </tbody>

</table>
