<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <pre>
        <?php
        echo "<br /> TESTE " . $hostname = setBase64('Bom@Web');
        echo "<br /> TESTE " . $hostname = getBase64('Qm9tQFdlYg==');
        ?>
    </pre>
    <br>
    #

    <pre>
        <?php
        echo "<br /> hostname " . $hostname = setBase64('bomweb-mysql80');
        echo "<br /> username " . $username = setBase64('root');
        echo "<br /> password " . $password = setBase64('pass123');
        echo "<br /> database " . $database = setBase64('bomweb');
        echo "<br /> DBDriver " . $DBDriver = setBase64('MySQLi');
        ?>
    </pre>
    <br>
    #

    <pre>
        <?php
        echo "<br /> hostname " . $hostname = setBase64('10.146.84.165');
        echo "<br /> username " . $username = setBase64('root');
        echo "<br /> password " . $password = setBase64('pass123');
        echo "<br /> database " . $database = setBase64('bomweb');
        echo "<br /> DBDriver " . $DBDriver = setBase64('MySQLi');
        ?>
    </pre>
    <br>
    #

    <pre>
        <?php
        echo "<br /> hostname " . $hostname = setBase64('mysql02-farm1.kinghost.net');
        echo "<br /> username " . $username = setBase64('habilida10_add4');
        echo "<br /> password " . $password = setBase64('Mi5tEri0');
        echo "<br /> database " . $database = setBase64('habilidade10');
        echo "<br /> DBDriver " . $DBDriver = setBase64('MySQLi');
        ?>
    </pre>
    <br>
    #

    <br>
    <?php
    for ($i = 0; $i < 20; $i++):
        echo criptoNew();
        ?>
        <br>
        ------
        <br>
    <?php endfor ?>
    <br>
    <br>
    <br>
    <br>
    Senhas e definições:
    <?php
    function criptoNew()
    {
        // $getTime = time();
        $getTime = time();
        $getPasswordHash = password_hash($getTime, PASSWORD_DEFAULT);
        $getMd5 = strtoupper(md5($getPasswordHash));
        strtoupper(md5(password_hash(date('Y-m-d H:i:s'), PASSWORD_DEFAULT)));
        return $getMd5;
    }

    function nameHash()
    {
        $getTime = time();
        $getPasswordHash = password_hash($getTime, PASSWORD_DEFAULT);
        $getMd5 = md5($getPasswordHash);
        return $getMd5;
    }

    function hashCripto()
    {
        $getTime = time();
        $getPasswordHash = password_hash($getTime, PASSWORD_DEFAULT);
        return $getPasswordHash;
    }

    function setBase64($parameter)
    {
        return base64_encode($parameter);
    }

    function getBase64($parameter)
    {
        return base64_decode($parameter);
    }
    ?>
    <h5>----------------------------</h5>
    <?= criptoNew(); ?>
    <h5>----------------------------</h5>
</body>

</html>