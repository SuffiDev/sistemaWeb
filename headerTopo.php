<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <?php  
                require("conexao.php");
                $query = "SELECT SUBSTRING(corpo, 1, 20) as corpo, titulo,tb_mensagem.id, data_cadastro FROM tb_mensagem INNER JOIN tb_leitura ON (tb_leitura.id_mensagem = tb_mensagem.id) WHERE tb_leitura.id_usuario = '".$_SESSION["id"]."' AND lido = '0' order by data_cadastro DESC limit 5";
                $result = mysqli_query($conn,$query);
                if(mysqli_num_rows($result) > 0){
                    while($item=mysqli_fetch_array($result)){
                        echo '<li>
                                <a href="#">
                                    <div>
                                        <strong>'.$item['titulo'].'</strong>
                                        <span class="pull-right text-muted">
                                            <em>'.date("d/m/Y", strtotime($item['data_cadastro'])).'</em>
                                        </span>
                                    </div>
                                    <div>'.$item['corpo'].'</div>
                                </a>
                            </li>
                            <li class="divider"></li>'; 
                            
                    }
                    echo '<li>
                            <a class="text-center" href="MinhasMensagens.php">
                                <strong>Ver todas as mensagens</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>';
                }else{
                    echo '<li>
                            <p class="text-center" href="#">
                                <strong>Nenhuma mensagem encontrada</strong>
                            </p>
                        </li>';
                }
            ?>            
        </ul>
        <!-- /.dropdown-messages -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> Seu Perfil</a>
            </li>
            <li class="divider"></li>
            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
            