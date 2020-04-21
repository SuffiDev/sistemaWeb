<?php
    session_start();
	require("conexao.php");
    $ano = $_GET['ano'];
    $query = "SELECT * FROM tb_holerite WHERE ano_referencia = '".$ano."' AND id_usuario='".$_SESSION['id']."' ORDER BY mes_referencia;";
    $result = mysqli_query($conn, $query);
    $opcoes = '';
    $content = '';
    if(mysqli_num_rows($result) > 0){
        while($item=mysqli_fetch_array($result)){
            switch ($item['mes_referencia']){
                //Montagem o <li> com as opções
                case 1:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#1" data-toggle="tab">Janeiro</a></li>';
                    else
                        $opcoes .= '<li><a href="#1" data-toggle="tab">Janeiro</a></li>';
                    break;
                case 2:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#2" data-toggle="tab">Fevereiro</a></li>';
                    else
                        $opcoes .= '<li><a href="#2" data-toggle="tab">Fevereiro</a></li>';
                    break;
                case 3:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#3" data-toggle="tab">Março</a></li>';
                    else
                        $opcoes .= '<li><a href="#3" data-toggle="tab">Março</a></li>';
                    break;
                case 4:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#4" data-toggle="tab">Abril</a></li>';
                    else
                        $opcoes .= '<li><a href="#4" data-toggle="tab">Abril</a></li>';
                    break;
                case 5:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#5" data-toggle="tab">Maio</a></li>';
                    else
                        $opcoes .= '<li><a href="#5" data-toggle="tab">Maio</a></li>';
                    break;
                case 6:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#6" data-toggle="tab">Junho</a></li>';
                    else
                        $opcoes .= '<li><a href="#6" data-toggle="tab">Junho</a></li>';
                    break;
                case 7:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#7" data-toggle="tab">Julho</a></li>';
                    else
                        $opcoes .= '<li><a href="#7" data-toggle="tab">Julho</a></li>';
                    break;
                case 8:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#8" data-toggle="tab">Agosto</a></li></li>';
                    else
                        $opcoes .= '<li><a href="#8" data-toggle="tab">Agosto</a></li>';
                    break;
                case 9:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#9" data-toggle="tab">Setembro</a></li>';
                    else
                        $opcoes .= '<li><a href="#9" data-toggle="tab">Setembro</a></li>';
                    break;
                case 10:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#10" data-toggle="tab">Outubro</a></li>';
                    else
                        $opcoes .= '<li><a href="#10" data-toggle="tab">Outubro</a></li>';
                    break;

                case 11:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#11" data-toggle="tab">Novembro</a></li>';
                    else
                        $opcoes .= '<li><a href="#11" data-toggle="tab">Novembro</a></li>';
                    break;

                case 12:
                    if($opcoes == '')
                        $opcoes .= '<li class="active"><a href="#12" data-toggle="tab">Dezembro</a></li>';
                    else
                        $opcoes .= '<li><a href="#12" data-toggle="tab">Dezembro</a></li>';
                    break;
            }
            //Montagem do tab-content
            if($content == ''){
                $content .= '<div class="tab-pane fade in active" id="'.$item['mes_referencia'].'">
                                <h4><a href="'.$item['caminho_documento'].'"  target="_blank"><p class="fa fa-eye"> Clique aqui para Visualizar </p></a></h4>
                            </div>';
            }else{
                $content .= '<div class="tab-pane fade" id="'.$item['mes_referencia'].'">
                                <h4><a href="'.$item['caminho_documento'].'" target="_blank"><p class="fa fa-eye"> Clique aqui para Visualizar </p></a></h4>
                            </div>';
            }
        }
        echo '<ul class="nav nav-tabs">
                '.$opcoes.'
            </ul>
            
            <div class="tab-content">
                '.$content.'
            </div> ';
    }else{
        echo '<h4>Nenhum Registro encontrado...</h4>';
    }
