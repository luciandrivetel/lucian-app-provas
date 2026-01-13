<!DOCTYPE html>

<html lang="pt" dir="ltr">
    <head>
        <title>Provas Medinfar</title>
        <meta charset="UTF-8">
        <meta name="description" content="Provas novas Medinfar">
        <meta name="viewport" content="width=device-width, initial=1.0">
        <style>
            header {
                text-align: center;
            }
            h1, h2 {
                text-align: center;
            }
            h1 {
                font-size: 38pt;
            }
            body {
                font-size: 14pt;
                font-family: Arial, Helvetica, sans-serif;
            }
            section {
                margin: 20px auto;
                max-width: 900px;
            }
            button {
                font-size: 12pt;
                font-family: Ubuntu;
                padding: 10px;
                max-width: 100px;
                min-width: 80px;
                border: 2px solid black;
                border-radius: 10px;
                background-color: none;
            }
            button:hover {
                background-color: rgb(219, 219, 219);
            }
            table {
                border-collapse: collapse;
                border: 2px solid black;
                width: 100%;
                font-size: 12pt;
            }
            th {
                text-align: center;
                border: 2px solid black;
                padding: 3px;
            }
            td {
                border: 1px solid black;
                padding: 3px;
            }

            .logo_tipocor {
                max-width: 500px;
                display: block;
                margin: auto;
            }
            .new_form {
                max-width: 900px;
                border-radius: 10px;
                border: 2px solid grey;
                padding: 10px;
                margin: 5px;

                text-align: center;

            }
            .new_form input {
                padding: 8pt;
                font-size: 12pt;
                margin-top: 10px;
                width: 70%;
                border-radius: 10px;
                border: none;
                background-color: #dfdfdf;
            }
            .new_form label {
                font-weight: bold;
            }
            .search_form {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 15px;

                padding: 10px;
                max-width: 900px;
                /* border-radius: 10px;
                border: 2px solid grey; */

                text-align: center;
            }
            .search_form label {
                font-weight: bold;
            }
            .search_form select,
            .search_form input {
                padding: 8pt;
                font-size: 12pt;
                margin-top: 3px;
            }
            .search_form button {
                grid-column: 1 / 3;
                justify-self: center;
            }
            .result {
                padding: 10px;
                margin-top: 20px;
                font-size: 14pt;
                background-color: #dfdfdf;
                border: none;
                border-radius: 10px;
                column-span: all;
                text-align: center;
            }
            .search_form_border {
                border-radius: 10px;
                border: 2px solid grey;
                padding: 8px;
            }

        </style>
    </head>

    <body>

        <header>
            <img  class="logo_tipocor" src="{{ asset('/images/logo_Tipocor.png') }}" alt="Logotipo Tipocor">
            <h1>Provas novas Medinfar</h1>
        </header>

        <main>
            <section>
                <h2>Prova nova</h2>
                <div class="new_form">
                    <form method="POST" action="{{ route('proof.store') }}">
                        @csrf
                        <label for="nome_material">O nome do material</label><br>
                        <input id="nome_material" type="text" name="nome" required placeholder="obrigatório"><br><br>

                        <label for="referencia">Rêferencia</label><br>
                        <input id="referencia" type="text" name="referencia" required placeholder="obrigatório"><br><br>

                        <label for="comentario">Comentário</label><br>
                        <input id="comentario" type="text" name="comment"><br><br>

                        <button type="submit">Guardar</button>
                    </form>
                </div>
            </section>

            <section>
                <h2>Procurar provas feitas</h2>
                <div class="new_form">
                    <form>
                        <label for="proc_prova">Rêferencia da prova</label><br>
                        <input id="proc_prova" type="text" name="referencia" required placeholder="obrigatório"><br><br>
                        <button type="submit">Procurar</button>
                    </form>
                    <div class="result">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Rêferencia</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Prova 1</td>
                                    <td>Nome 1</td>
                                    <td>Data 1</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </section>

            <section>
                <h2>Provas feitas por mês e ano</h2>
                <div class="search_form_border">
                    <form class="search_form" method="GET" action="{{ route('proof.searchByDate') }}">
                        <!--Randul 1-->
                        <label for="month">Escolha a mês</label>
                        <label for="year">Digite o ano</label>
                        <!--Randul 2-->
                        <select id="month" name="mes">
                            <option value="">Escolha a mês</option>
                            <option value="01">Janeiro</option>
                            <option value="02">Fevreiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outobro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                        <input id="year" type="number" name="ano" placeholder="Ano">

                        <button type="submit">Procurar</button>
                    </form>
                <div class="result">
                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Rêferencia</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($proofs)
                                @forelse($proofs as $proof)
                                <tr>
                                    <td>{{ $proof->nome }}</td>
                                    <td>{{ $proof->referencia }}</td>
                                    <td>{{ $proof->data }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">Nenhum resultado</td>
                                </tr>

                            @endisset
                        </tbody>

                    </table>
                </div>
                </div>
            </section>
        </main>

    </body>
</html>
