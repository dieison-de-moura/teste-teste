<!--
Esta é a camada de intereção com o usuário.
-->
<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Referência externa aos arquivos do bootstrap -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="
    anonymous">

    <link href="css/estilo.css" rel="stylesheet" />
    <link rel="icon" href="img/favicon.jpg" />
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->

    <title>Home</title>
</head>
<body>
<div class="container" style="margin-top: 15px;">
<p class="text-center"><?php echo $mensagem;?></p>
<table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Quantidade dezenas</th>
                <th scope="col">Jogos</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($jogos) && is_array($jogos)) {
                foreach ($jogos as $chave => $valor) { ?>

                    <tr>
                        <th scope="row"><?php echo $chave ?></th>
                        <td><?php echo $valor['nome'] ?></td>
                        <td><?php echo $valor['dezenas'] ?></td>
                        <td><?php echo implode(', ', $valor['jogos']) ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
	</div>
</body>
</html>