<?php 
namespace GrudTeste\custom\controller;

use GrudTeste\util\Sessao;
use GrudTeste\custom\view\SBTemplate;

class MainIndex{
    
    public function main(){
        $sessao = new Sessao();
        if (isset($_GET["sair"])) {
            $sessao->mataSessao();
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=.">';
        }
        
        if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM){
            $this->paginaAdmin();
        }else{
            $this->paginaComum();
        }
    }

    public function paginaAdmin(){
        
        /*Deve mostrar o template do dashboard, com página de cadastro de cliente.
         * E cadastro de boleto. 
         * 
         */ 
        
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
        
        $adminTemplate = new SBTemplate();
        $adminTemplate->head();
        $adminTemplate->sideBar();
        $adminTemplate->wapperOpen();
        $adminTemplate->topBar();
//         $adminTemplate->content();
        $this->contentAdmin();
        $adminTemplate->wapperClose();
        $adminTemplate->footer();
        
    }
    public function paginaComum(){
        /*
         * Deve mostrar a página inicial e 
         * a lista de boletos de um
         * cliente selecionado por cnpj.
         *  
         */
        if(!isset($_GET['page'])){
            $this->landPage();
            return;
        }
        if($_GET['page'] == 'login'){
            $this->paginaLogin();
        }else if($_GET['page'] == 'cliente'){
            if(isset($_GET['select'])){
                if($_GET['select'] == "789456123"){
                    $sessao = new Sessao();
                    $sessao->criaSessao(1, Sessao::NIVEL_ADM, 'JOSE');
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=.">';
                    return;
                }
                $controller = new ClienteCustomController();
                $controller->main();
            }
            
        }
        
    }
    public function paginaLogin(){
        echo '

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div id="login-box">
            <div class="logo">
                <img src="imagens/logobel.png" class="img img-responsive  center-block"/>
                <h1 class="logo-caption"><span class="tweak"></span>ENTRAR</h1>
            </div><!-- /.logo -->
            <div class="controls">
                <form>
                    <input type="hidden" name="page" value="cliente">
                    <input type="text" name="select" placeholder="Digite seu CNPJ" class="form-control">               
                    <button type="submit" class="btn btn-default btn-block btn-custom">ENTRAR</button>
                </form>              
                 
            </div><!-- /.controls -->
        </div><!-- /#login-box -->
    </div><!-- /.container -->
    <div id="particles-js"></div>
    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>-->

  
</body>

<script>
    $.getScript("https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js", function(){
    particlesJS(\'particles-js\',
      {
        "particles": {
          "number": {
            "value": 80,
            "density": {
              "enable": true,
              "value_area": 800
            }
          },
          "color": {
            "value": "#ffffff"
          },
          "shape": {
            "type": "circle",
            "stroke": {
              "width": 0,
              "color": "#000000"
            },
            "polygon": {
              "nb_sides": 5
            },
            "image": {
              "width": 100,
              "height": 100
            }
          },
          "opacity": {
            "value": 0.5,
            "random": false,
            "anim": {
              "enable": false,
              "speed": 1,
              "opacity_min": 0.1,
              "sync": false
            }
          },
          "size": {
            "value": 5,
            "random": true,
            "anim": {
              "enable": false,
              "speed": 40,
              "size_min": 0.1,
              "sync": false
            }
          },
          "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
          },
          "move": {
            "enable": true,
            "speed": 6,
            "direction": "none",
            "random": false,
            "straight": false,
            "out_mode": "out",
            "attract": {
              "enable": false,
              "rotateX": 600,
              "rotateY": 1200
            }
          }
        },
        "interactivity": {
          "detect_on": "canvas",
          "events": {
            "onhover": {
              "enable": true,
              "mode": "repulse"
            },
            "onclick": {
              "enable": true,
              "mode": "push"
            },
            "resize": true
          },
          "modes": {
            "grab": {
              "distance": 400,
              "line_linked": {
                "opacity": 1
              }
            },
            "bubble": {
              "distance": 400,
              "size": 40,
              "duration": 2,
              "opacity": 8,
              "speed": 3
            },
            "repulse": {
              "distance": 200
            },
            "push": {
              "particles_nb": 4
            },
            "remove": {
              "particles_nb": 2
            }
          }
        },
        "retina_detect": true,
        "config_demo": {
          "hide_card": false,
          "background_color": "#b61924",
          "background_image": "",
          "background_position": "50% 50%",
          "background_repeat": "no-repeat",
          "background_size": "cover"
        }
      }
    );

});

</script>

</html>

';
        
        
    }
    public function landPage(){
        
        echo '
<!DOCTYPE html>
<html lang="pt-br">
            
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
            
  <title>SUPORTE BEL INFORMÁTICA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
            
  <!-- Favicons -->
  <link href="favibel.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
            
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
            
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
            
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>
            
<body>
            
  <!-- ======= CABEÇALHO ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container-fluid"></div>
            
      <div class="row justify-content-center">
        <div class="col-xl-11 d-flex align-items-center">
            <a href="index.html" class="logo mr-auto" id="sombra"><img src="imagens/logo-250.png" alt="LOGO BEL INFORMÁTICA"class="img-fluid"></a>
            
          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li class="active"><a href=".">INÍCIO</a></li>
              <li><a href="#about">SOBRE A EMPRESA</a></li>
              <li><a href="?page=login">2º VIA DE BOLETO</a></li>
              <li><a href="#contact">CONTATO</a></li>
              <li class="drop-down"><a href="#">Vídeos</a>
                <ul>
                  <li class="digisat"><a href="digisat.html">Digisat G6</a></li>
                  <li class="shop9"><a href="shop.html">Shop Control 9</a></li>
            
                </ul>
              </li>
            </ul>
          </nav><!-- .nav-menu -->
        </div>
      </div>
            
  </header><!-- FIM CABEÇALHO -->
            
  <!-- ======= SEÇÃO INICIAL ======= -->
  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">
            
        <ol class="carousel-indicators"></ol>
            
        <div class="carousel-inner" role="listbox">
            
          <div class="carousel-item active" style="background-image: url(imagens/bg-1200.jpg)">
          <div class="carousel-item active">
            <div class="carousel-container"></div>
              <div class="container">
                <h2 class="animate__animated animate__fadeInDown">SUPORTE TÉCNICO BEL INFORMÁTICA</h2>
                <p class="animate__animated animate__fadeInUp">Clicando em um dos botões abaixo você faz o download de um de nossos acessos e permite ter acesso remoto ao seu computador e assim resolver diversos tipos de problemas.</p>
                <a href="http://download.teamviewer.com/download/version_12x/TeamViewer_Setup.exe" class="btn-get-started scrollto animate__animated animate__fadeInUp">TEAMVIEWER 12</a>
                <a href="https://download.anydesk.com/AnyDesk.exe?_ga=2.44957092.1642762274.1614293414-998849477.1603384481" class="btn-get-started scrollto animate__animated animate__fadeInUp">ACESSO ANYDESK </a>
              </div>
            </div>
          </div>
      </div>
    </div>
    </div>
  </section><!-- FIM SEÇÃO INICIAL -->
            
  <main id="main">
            
            
    <!-- ======= SOBRE A EMPRESA SEÇÃO ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
            
        <header class="section-header">
          <h3>SOBRE A EMPRESA</h3>
          <p>Bel Informática ltda, é uma empresa nacional fundada em 2008 com sede em Belém-PA. A empresa possui forte atuação em todo o estado do Pará, e divide seus segmentos em: implantação de sistemas e venda de Equipamento de Informática em geral.</p>
        </header>
            
        <div class="row about-cols">
            
       </div>
      </div>
    </section><!-- FIM SEÇÃO SOBRE A EMPRESA -->
            
    <!-- ======= SEÇÃO DE SERVIÇOS ======= -->
    <section id="services">
      <div class="container" data-aos="fade-up">
            
        <header class="section-header wow fadeInUp">
          <h3>NOSSOS SERVIÇOS</h3>
          <p>Trabalhamos todos focados em inovação tecnológica e no melhor atendimento aos nossos clientes. Nos preocupamos sempre com o melhor uso de nossos sistemas e total entendimento do cliente.</p>
        </header>
            
        <div class="row">
            
          <div class="col-lg-4 col-md-6 box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="ion-settings"></i></div>
            <h4 class="title"><a href="#">SUPORTE TÉCNICO</a></h4>
            <p class="description">Temos uma Equipe especializada e preparada para prestar suporte em relação aos softwares Digisat G6 e ShopControl 9</p>
          </div>
          <div class="col-lg-4 col-md-6 box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="ion-woman"></i></div>
            <h4 class="title"><a href="#">APOIO AO CLIENTE</a></h4>
            <p class="description">De Segunda a Sexta em horário comercial nossa equipe está a total disposição de nossos clientes para apoio técnico ou dúvidas dos sistemas.</p>
          </div>
          <div class="col-lg-4 col-md-6 box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="ion-android-desktop"></i></div>
            <h4 class="title"><a href="#">IMPLANTAÇÃO DE SISTEMAS</a></h4>
            <p class="description">Ao adquirir um de nossos softwares você recebe a implantação e treinamento especializado de nossa equipe.</p>
          </div>
            
        </div>
            
      </div>
    </section><!-- End Services Section -->
            
            
    <!-- ======= PARCEIROS ======= -->
    <section id="clients">
      <div class="container" data-aos="zoom-in">
            
        <header class="section-header">
          <h3>NOSSOS PARCEIROS</h3>
        </header>
            
        <div class="owl-carousel clients-carousel">
          <img src="imagens/digisat-par.jpg" alt="logo Digisat Tecnologia">
          <img src="imagens/ideal02.png" alt="Logo Ideal Soft">
          <img src="imagens/logo-250.png" id="bellogo" alt="Logo Bel informática">
        </div>
            
      </div>
    </section><!-- End Our Clients Section -->
            
            
    <!-- ======= SEÇÃO DE CONTATO ======= -->
    <section id="contact" class="section-bg">
      <div class="container" data-aos="fade-up">
            
        <div class="section-header">
          <h3>ENTRE EM CONTATO</h3>
          <p>É nosso cliente e precisa de ajuda ? Será um prazer atender você!</p>
        </div>
            
        <div class="row contact-info">
            
          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-time-outline"></i>
              <h3 class="contato">Horário de funcionamento:</h3>
              <p>Segunda a Sexta <br>
                8:30 às 12:00 <br>
                13:00 às 18:00
            </p>
            
            </div>
          </div>
            
          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3 class="contato">Telefone e Whatsapp:</h3>
              <p><a href="telefone:+5591985445267">(91) 985445267</a></p>
            </div>
          </div>
            
          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3 class="contato">Email:</h3>
              <p>adriel@suportebel.com.br</p>
              <p class="luis">luis@suportebel.com.br</p>
            </div>
          </div>
        </div>
            
      </div>
    </section><!-- fim seção de contato Section -->
            
  </main><!-- End #main -->
            
  <!-- ======= Footer ======= -->
  <footer id="footer">
      <div class="container">
        <div class="row">
        </div>
      </div>
            
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Adriel Teles</strong>. Todos os direitos reservados.
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
      -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->
            
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>
            
  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
            
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
            
</body>
</html>
            
';
    }
    
    public function contentAdmin(){
        
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

                default:
                    echo '<p>Página solicitada não encontrada.</p>';
                    break;
            }
        }else{
            $controller = new ClienteCustomController();
            $controller->main();
        }
    }
}

?>