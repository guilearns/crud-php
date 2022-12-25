<?php
    require 'connection.php';
    require 'reqs/paginas_reqs.php';
    require 'reqs/funcionalidades.php';
    require 'templates/header.php';
    require 'templates/footer.php';
    require 'templates/navbar.php';
?>

<?php
    adicionarHeader();
?>

    <body class="p-0 m-0 border-0">

        <?php renderizarNavbar(); ?>

        <?php

            $userid = pegarUserId();

            $connection = new Connection();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $prepExcCores = $connection->getConnection()->prepare("DELETE FROM user_colors WHERE user_id = :id");

                $prepExcCores->bindParam(':id', $_POST["id"]);

                $prepExcCores->execute();

                $prepExcConta = $connection->getConnection()->prepare("DELETE FROM users WHERE id = :id");

                $prepExcConta->bindParam(':id', $_POST["id"]);

                $prepExcConta->execute();


            }

            $users = $connection->query("SELECT * FROM users WHERE id = $userid");

            $users = $users->fetch(PDO::FETCH_ASSOC);

            #$connection->query("DELETE FROM user_colors;");

            #A função abaixo foi declarada em reqs/funcionalidades.php
            excluirUsuarios($users);

        ?>

    </body>

<?php adicionarFooter(); ?>