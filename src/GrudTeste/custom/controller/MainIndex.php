<?php 
namespace GrudTeste\custom\controller;

class MainIndex{
    
    public function main(){
        
        if(isset($_GET['ajax'])){
            switch ($_GET['ajax']){
                case 'boleto':
                    $controller = new BoletoCustomController();
                    $controller->mainAjax();
                    break;
                case 'cliente':
                    $controller = new ClienteCustomController();
                    $controller->mainAjax();
                    break;
                case 'usuario':
                    $controller = new UsuarioCustomController();
                    $controller->mainAjax();
                    break;
                default:
                    echo '<p>Página solicitada não encontrada.</p>';
                    break;
            }
            return;
        }
        
        $this->content();
        
    }

    
    public function content(){
        
        if(isset($_GET['page'])){
            switch ($_GET['page']){
                case 'boleto':
                    $controller = new BoletoCustomController();
                    $controller->main();
                    break;
                case 'cliente':
                    $controller = new ClienteCustomController();
                    $controller->main();
                    break;
                case 'usuario':
                    $controller = new UsuarioCustomController();
                    $controller->main();
                    break;
                default:
                    echo '<p>Página solicitada não encontrada.</p>';
                    break;
            }
        }else{
            $controller = new UsuarioCustomController();
            $controller->main();
        }
    }
}

?>