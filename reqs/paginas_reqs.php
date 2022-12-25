<?php

####################################################
# A função abaixo é utilizada no arquivo index.php #
####################################################

function listarUsuarios($users) {

    echo "
        <form>
            <div class='container text-center mt-3'>

                <div class='card mb-3'>
                    <div class='card-header'>
                        Lista de Usuários
                    </div>

                    <div class='card-body'>
            
                        <p class='fw-lighter lh-1'>Cada linha abaixo representa um usuário com seu respectivo ID, nome, email e ações.</p>
                        <p class='fw-lighter lh-1'>Em ações, há duas opções disponíveis para cada usuário: \"excluir\" e \"editar\". A opção \"excluir\" permite que você remova o usuário da lista, enquanto que a opção \"editar\" lhe dá a possibilidade de vincular e desvincular cores pessoais do usuário.</p>
                        <p class='fw-lighter text-danger lh-1'>Além disso, é importante lembrar que a ação \"excluir\" deve ser utilizada com cautela, pois ela tem consequências irreversíveis.</p>
                        
                    </div>
                </div>

                <div class='row'>
                    <div class='col-1'><strong>ID</strong></div>    
                    <div class='col-4'><strong>Nome</strong></div>    
                    <div class='col-5'><strong>Email</strong></div>
                    <div class='col-2'><strong>Ações</strong></div> 
                    <hr>   
                </div>

                <div class='row align-items-center'>
    ";

    foreach($users as $user) {

        echo sprintf("
                    
                    <div class='col-1'>%s</div>
                    <div class='col-4'>%s</div>
                    <div class='col-5'>%s</div>
                    <div class='col-2'>
                        <a href='./editar.php?id=%s'>Editar</a>
                        <a href='./excluir_usuario.php?id=%s'>Excluir</a>
                    </div>
                    <hr class='mt-2'>
                
                    ",
                    $user->id, $user->name, $user->email, $user->id, $user->id);
        }

    echo "
                </div>
            </div>
        </form>
    ";

}

############################################################
# A função abaixo é utilizada no arquivo criar_usuario.php #
############################################################

function criarUsuarios($emailJaExiste) {

    echo "

        <form method='post' action='criar_usuario.php'>

            <div class='container text-center mt-3'>";

            if($_SERVER['REQUEST_METHOD']) {

                validarEmail($emailJaExiste);

            }  

    echo "

                <div class='card mb-3'>

                    <div class='card-header'>
                        Criar Usuário
                    </div>

                    <div class='card-body'>

                        <div class='input-group flex-nowrap mx-auto mb-3'>
                            <span class='material-symbols-rounded input-group-text' id='addon-wrapping'>Badge</span>
                            <input type='text' name='nome' class='form-control' placeholder='Nome' aria-label='Nome' aria-describedby='addon-wrapping'>
                        </div>
        
                        <div class='input-group flex-nowrap mx-auto mb-3'>
                            <span class='material-symbols-rounded input-group-text' id='addon-wrapping'>Mail</span>
                            <input type='text' name='email' class='form-control' placeholder='Email' aria-label='Email' aria-describedby='addon-wrapping'>
                        </div>
        
                    </div>
                    
                </div>

                <div class='mb-3'>
                    <button class='btn btn-outline-success'type='submit'>Criar Usuário</button>
                </div>

            </div>
        </form>
            
    ";

}

#####################################################
# A função abaixo é utilizada no arquivo editar.php #
#####################################################

function editarUsuario($users, $colors, $user_colors) {

        echo sprintf("

            <form id='desvincular'method='post' action='editar.php'></form>
            <form method='post' action='editar.php'>

                <div class='container text-center mt-3'>
                
                    <div class='card mb-3'>

                        <div class='card-header'>
                            Editar Usuário
                        </div>
                    
                        <div class='card-body'>
        
                            <div class='row'>
                                <div class='col-4 ps-5'><strong>ID</strong></div>    
                                <div class='col-4'><strong>Nome</strong></div>    
                                <div class='col-4 pe-5'><strong>Email</strong></div>
                                <hr>   
                            </div>

                            <div class='row align-items-center'>
                                <div class='col-4 ps-5'>%s</div>
                                <div class='col-4'>%s</div>
                                <div class='col-4 pe-5'>%s</div>
                            </div>

                    </div>
                        
                    <div class='container px-1'>

                        <div class='row align-items-center mx-1'>

                            <div class='col card mb-2 me-2' style='min-height: 224px;'>

                                <div class='card-h mt-1'>
                                    Vincular Cor <hr class='mt-1'>
                                </div>

                                <div class='card-body'>
                                
                                    <select class='mx-1 mb-3 mt-3' id='select' name='color_id'>
                    ",
                    $users['id'], $users['name'], $users['email']);
                                        
                                        #<select> Início do loop com as cores
                                        foreach($colors as $color) {

                                            echo sprintf('<option value="%s">%s</option>',
                                            $color->id, $color->name);
                                            
                                            }
                                        #<select> Fim do loop com as cores

        echo sprintf("              
                                    </select>
                                    
                                    <div>
                                        <button class='btn btn-outline-dark' type='submit' name='id' value='%s'>Vincular</button>
                                    </div>

                                </div>

                            </div>

                            <div class='col card mb-2' style='min-height: 224px;'>
                                <div class='card-h mt-1'>Cores Vinculadas <hr class='mt-1'></div>
                                <div class='card-body p-0'>
                            
                    ", $users['id']);
                        
                                    foreach($user_colors as $user_color) {

                                        echo sprintf('
                                            
                                            <div class="row align-items-center">

                                                    <div class="col text-end p-0 m-0 mb-1">
                                                        <input class="justify-content-center" type="checkbox" form="desvincular" name="%s" value="%s">
                                                    </div>
                                                    
                                                    <div class="col text-start p-0 ms-1 me-4 mb-1">
                                                        <span>%s</span>
                                                    </div>
                                        
                                            </div>
                                        ',
                                        $user_color->name, $user_color->color_id, $user_color->name);
                            
                                    } 

                                    if(empty($user_color)) {
                                        echo '<p>Nenhuma</p>';
                                    } else {
                                        echo sprintf('
                                            <div class="mt-1">
                                                <button class="btn btn-outline-dark" type="submit" form="desvincular" name="id" value="%s">Desvincular</button>
                                            </div>
                                        </div>
                                    </div>',
                                            $users['id']);

                                    }

        echo "      </div>
                  </div>
                </div>
            </form>";
    
}

##############################################################
# A função abaixo é utilizada no arquivo excluir_usuario.php #
##############################################################

function excluirUsuarios($users) {

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        echo sprintf("
 
            <div class='container text-center mt-3'>

                <div class='card mb-3'>

                    <div class='card-header'>
                        Excluir Usuário
                    </div>

                    <div class='card-body'>

                        <div class='row'>
                            <div class='col'><strong>ID</strong></div>    
                            <div class='col'><strong>Nome</strong></div>
                            <div class='col'><strong>Ação</strong></div>  
                            <hr>  
                        </div>

                        <div class='row'>
                            <div class='col'>%s</div>    
                            <div class='col'>%s</div>
                            <div class='col'>%s</div>  
                        </div>

                    </div>

                </div>
                                                
                <p>
                    Atenção! Esta ação não poderá ser desfeita.
                </p>
                        
                <form method='post' action='./excluir_usuario.php?id=%s'>
                    <button class='btn btn-outline-danger' type='submit' value='%s' name='id'>Excluir</button>
                </form>
    
        ",
        $users['id'], $users['name'], $users['email'], $users['id'],$users['id']);

        }


    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "

        <div class='container text-center mt-3'>
            <div class='alert alert-success' role='alert'>
                Usuário deletado com Sucesso!
            </div>

            <div>
                <a href='./index.php'>Voltar para a página inicial</a>
            </div>
            ";

    }

    echo "</div>";

}

?>