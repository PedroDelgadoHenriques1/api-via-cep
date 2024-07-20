<!--*EXTRA* Interface de preenchimento automático ao inserir CEP-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta CEP</title>
    <link rel="stylesheet" href="{{ asset('css/cep.css') }}">
    <script>
        function limpa_formulário_cep() {
            document.getElementById('rua').value = ("");
            document.getElementById('complemento').value = ("");
            document.getElementById('bairro').value = ("");
            document.getElementById('cidade').value = ("");
            document.getElementById('uf').value = ("");
            document.getElementById('ibge').value = ("");
            document.getElementById('gia').value = ("");
            document.getElementById('ddd').value = ("");
            document.getElementById('siafi').value = ("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                document.getElementById('cep').value = conteudo.cep;
                document.getElementById('rua').value = conteudo.logradouro;
                document.getElementById('complemento').value = conteudo.complemento;
                document.getElementById('bairro').value = conteudo.bairro;
                document.getElementById('cidade').value = conteudo.localidade;
                document.getElementById('uf').value = conteudo.uf;
                document.getElementById('ibge').value = conteudo.ibge;
                document.getElementById('gia').value = conteudo.gia;
                document.getElementById('ddd').value = conteudo.ddd;
                document.getElementById('siafi').value = conteudo.siafi;
            } else {
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisacep(valor) {
            var cep = valor.replace(/\D/g, '');

            if (cep != "") {
                var validacep = /^[0-9]{8}$/;

                if (validacep.test(cep)) {
                    document.getElementById('rua').value = "...";
                    document.getElementById('complemento').value = "...";
                    document.getElementById('bairro').value = "...";
                    document.getElementById('cidade').value = "...";
                    document.getElementById('uf').value = "...";
                    document.getElementById('ibge').value = "...";
                    document.getElementById('gia').value = "...";
                    document.getElementById('ddd').value = "...";
                    document.getElementById('siafi').value = "...";

                    var script = document.createElement('script');
                    script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';
                    document.body.appendChild(script);

                } else {
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } else {
                limpa_formulário_cep();
            }
        }
    </script>
</head>
<body>
    <h1>Consulta CEP</h1>
    <form action="javascript:void(0);">
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="9" onblur="pesquisacep(this.value);" /><br><br>

        <label for="rua">Logradouro:</label>
        <input type="text" id="rua" name="rua" /><br><br>

        <label for="complemento">Complemento:</label>
        <input type="text" id="complemento" name="complemento" /><br><br>

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" /><br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" /><br><br>

        <label for="uf">Estado:</label>
        <input type="text" id="uf" name="uf" /><br><br>

        <label for="ibge">IBGE:</label>
        <input type="text" id="ibge" name="ibge" /><br><br>

        <label for="gia">GIA:</label>
        <input type="text" id="gia" name="gia" /><br><br>

        <label for="ddd">DDD:</label>
        <input type="text" id="ddd" name="ddd" /><br><br>

        <label for="siafi">SIAFI:</label>
        <input type="text" id="siafi" name="siafi" /><br><br>
    </form>
</body>
</html>
