<?php 
    require 'connection.php';
    require 'reqs/paginas_reqs.php';
    require 'reqs/funcionalidades.php';
    require 'templates/header.php';
    require 'templates/footer.php';
    require 'templates/navbar.php';
?>

<?php adicionarHeader(); ?>

    <body>

        <?php renderizarNavbar(); ?>

        <div class='container m-auto'>
        
            <?php

                $userid = pegarUserId();

                $connection = new Connection();
                
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["color_id"])) {
                    $userid = $_POST["id"];
                    $color_id = $_POST["color_id"];
                    vincularCor($connection, $userid, $color_id);
                }

                if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST["color_id"])) {

                    $color = $connection->query("SELECT name FROM colors");
                    $color = $color->fetchAll(PDO::FETCH_ASSOC);
                
                    foreach($color as $c) {
                        $cor = $c["name"];
                        if(isset($_POST[$cor])){

                            $prepExcCores = $connection->getConnection()->prepare("DELETE FROM user_colors WHERE user_id = :id AND color_id = :color_id");

                            $prepExcCores->bindParam(':id', $_POST["id"]);
                            $prepExcCores->bindParam(':color_id', $_POST[$cor]);

                            $prepExcCores->execute();
                        }
    
                        }

                }

                $users = $connection->query("SELECT * FROM users WHERE id = $userid");

                $users = $users->fetch(PDO::FETCH_ASSOC);

                $colors = $connection->query("SELECT * FROM colors");

                $user_colors = $connection->query("SELECT colors.name, user_colors.color_id FROM colors INNER JOIN user_colors ON colors.id = user_colors.color_id WHERE user_colors.user_id = $userid;");
                
                #A função abaixo foi declarada em reqs/funcionalidades.php
                editarUsuario($users, $colors, $user_colors);

            ?>

        </div>
    
    </body>

<?php adicionarFooter(); ?>


