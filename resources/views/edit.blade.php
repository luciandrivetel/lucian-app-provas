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
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
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
            .message_success {
                color: green;
                text-align: center;
                background-color: lightgray;
                border-radius: 10px;
                padding: 10px;
                margin: 5px;
                max-width: 900px;
            }
            .message_error {
                color: red;
                text-align: center;
                background-color: lightgrey;
                border-radius: 10px;
                padding: 10px;
                margin: 5px;
                max-width: 900px;
            }

        </style>
    </head>

    <body>

        <header>
            <img  class="logo_tipocor" src="{{ asset('/images/logo_Tipocor.png') }}" alt="Logotipo Tipocor">
            <h1>Provas Medinfar</h1>
        </header>

        <main>
            <section>
                @if (session('error'))
                    <div class="message_error">
                        {{ session('error') }}
                    </div>
                @endif
            </section>
            <section>
                <h2>Editar prova: <em style="color: darkgray">{{ $proof->nome }} {{ $proof->referencia }}</em></h2>
                <div class="new_form">
                    <form method="POST" action="{{ route('proofs.update', $proof->id) }}">
                        @csrf  {{-- ca sa imi ia in forma si tokenul --}}
                        @method('put')   {{-- ca sa transforme POST in put sau patch altfel nu merge pentru ca la method in html am doar GET si POST --}}
                        <label for="nome_material">O nome do material</label><br>
                        <input id="nome_material" type="text" name="nome" value="{{ $proof->nome }}"><br><br>

                        <label for="referencia">Rêferencia</label><br>
                        <input id="referencia" type="text" name="referencia" value="{{ $proof->referencia }}"><br><br>

                        <label for="comentario">Comentário</label><br>
                        <input id="comentario" type="text" name="comment" value="{{ $proof->comment }}"><br><br>

                        <button type="submit">Editar</button>
                    </form>
                </div>
            </section>

        </main>

    </body>
</html>
