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
                
                $emailJaExiste = null;

                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $nome = $_POST["nome"];
                    $email = $_POST["email"];

                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                        $emailJaExiste = verificarExistenciaDoEmail($email);

                        if(empty($emailJaExiste)) {
    
                            addUsuarioNoDB($nome, $email);
                            $emailJaExiste = 'nao';
    
                        } else {
    
                            $emailJaExiste = 'sim';
    
                        }
    
                    } else {
                        
                        $emailJaExiste = 'erro';
                    }                       

                    } 
                
                #A função abaixo foi declarada em reqs/funcionalidades.php
                criarUsuarios($emailJaExiste);

            ?>
        </div>
        
    </body>

<?php adicionarFooter(); ?>