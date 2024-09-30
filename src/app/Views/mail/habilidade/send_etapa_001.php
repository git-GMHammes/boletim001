<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Token</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .card {
            width: 300px;
            height: 200px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        .card a {
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .card a:hover {
            background-color: #0056b3;
        }

        .card .link-text {
            color: #555;
            font-size: 14px;
            word-wrap: break-word;
            /* Quebra de palavra */
            word-break: break-all;
            /* Quebra automática se necessário */
        }
    </style>
</head>

<body>
    <?php
    $key1 = isset($result['access_key_01']) ?  trim($result['access_key_01']) : '';
    $key2 = isset($result['access_key_02']) ?  trim($result['access_key_02']) : '';
    $key3 = isset($result['access_key_03']) ?  trim($result['access_key_03']) : '';
    ?>
    <div class="card">
        <a href="<?= base_url(); ?>/bw/habilidade/usuario/api/loginEtapa2/<?= $key1; ?>/<?= $key2; ?>/<?= $key3; ?>"
            target="_blank">Acesso ao Sistema</a>
        <p class="link-text">
            <?= base_url(); ?>/bw/habilidade/usuario/api/loginEtapa2/<?= $key1; ?>/<?= $key2; ?>/<?= $key3; ?>
        </p>
    </div>

</body>

</html>