<?php
    require 'connection.php';
    require 'reqs/paginas_reqs.php';
    require 'reqs/funcionalidades.php';
    require 'templates/header.php';
    require 'templates/footer.php';
    require 'templates/navbar.php';
?>

<?php adicionarHeader(); ?>

    <body class="p-0 m-0 border-0">

        <?php renderizarNavbar(); ?>

        <div class='container m-auto'>

            <?php

                $connection = new Connection();

                $users = $connection->query("SELECT * FROM users");

                #A função abaixo foi declarada em reqs/funcionalidades.php
                listarUsuarios($users);

            ?>

        </div>
    
    </body>

<?php adicionarFooter(); ?>