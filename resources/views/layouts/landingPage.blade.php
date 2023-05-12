<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset("css/landing_page/layout.css")}}">
  @yield("links")
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto+Flex:opsz,wght@8..144,100;8..144,300;8..144,500;8..144,700;8..144,900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield("title")</title>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  <style>
    .announceContainer{
      width: 100%;
      padding: 40px 200px;
      background-color: #f6f3fe;
    }
    .announce{
      width: 100%;
      padding: 30px 20px;
      background-color: #fff;
      border-radius: 8px;
    }
    .heading{
      font-size: 18px;
      letter-spacing: 2px;
      text-transform: uppercase;
    }
    .announceDescription{
      background-color: #f6f3fe;
      border-radius: 10px;
      padding: 20px;
      letter-spacing: 1px;
    }

    .heading, .announceDescription,.table{
      margin-bottom: 15px;
    }

    .ctaContainer{
      padding: 30px;
      text-align: center;
    }

    .cta{
      padding: 10px 20px;
      background-color: #09375D;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-radius: 2px;
      margin: 10px auto;
      transition: .4s ease;
      text-decoration: none;
      color: #f6f3fe;
    }
    .cta:hover{
      background-color: #f6f3fe;
      border: 2px solid #09375D;
      color: #09375D;
      font-weight: 500;
    }

    .comments{
      width: 100%;
    }

    .comments .container, .comments .card, .comments .card-body,.comments .form{
      width: 100%;
      border: none;
    }

    .comments .card-body{
      width: 100%;
      border: 1px solid rgba(0, 0, 0, 0.1);
      border-radius: 5px;
      box-shadow: 1px 2px 10px rgba(0, 0, 0, 0.1);
    }

    body{
      overflow-x: hidden;
    }

    .menu{
      padding: 7px 150px;
      background-color: #fff;
      color: rgba(0, 0, 0, 0.5);
      box-shadow: 5px 10px 12px rgba(0, 0, 0, 0.3);
    }

    .menu a, .main-navlinks .navlinks-container a{
      color: rgba(0, 0, 0, 0.5);
      margin-right: 10px;
      font-size: 18px;
    }

    .sign a{
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: bold;
      text-decoration: none;
      font-size: 14px;
      margin: 0;
      color: #fff;
    }

    .sign .signA{
      padding: 0;
      margin-right: 10px;
      color: #4e73de;
    }

    .nvAnnonce{
      background-color: #fff;
      border: 2px solid #4e73de;
      color: #4e73de;
      padding: 7px 10px;
      border-radius: 3px;
      transition: .4s ease;
    }

    .loginBtn{
      background-color: #4e73de;
      color: #fff;
      padding: 7px 10px;
      border-radius: 3px;
      transition: .4s ease;
      border: none;
      border-radius: 5ùpx;
    }

    .nvAnnonce:hover{
      border-radius: 20px;
    }
    .loginBtn:hover{
      background-color: #fff;
      border: 2px solid #4e73de;
      color: #4e73de;
      border-radius: 20px;
    }
    .signB:hover a{
      color: #4e73de;
    }
    .header-section{
      background: linear-gradient(#4e73de, #36b9cc);
      color: white;
      height: 100vh;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
      display: flex;
      justify-content: center;
      flex-direction: column;
      clip-path: polygon(100% 0, 100% 100%, 74% 93%, 44% 100%, 22% 93%, 0 100%, 0 0);
    }
    .publiciter{
      margin-bottom: 50px;
    }
    .publiciter .h1{
      font-weight: bold;
      letter-spacing: 2px;
      background: none;
      font-size: 60px;
      /* text-shadow: 1px 1px 30px rgba(0, 0, 0, 0.5); */
    }
    .publiciter .pubParagraphe{
      font-weight: bold;
      letter-spacing: 2px;
      background: none;
      font-size: 20px;
      /* text-shadow: 1px 1px 30px rgba(0, 0, 0, 0.5); */
    }
    .filterRecherche{
      width: 60%;
      padding: 20px 10px;
      border-radius: 5px;
    }
    .bottom_text{
      background-color: #36b9cc;
      border: none;
    }
    .footer{
      background: linear-gradient(#4e73de, #36b9cc);
    }
    .darkum{
      color: white;
      cursor: pointer;
      font-weight: bold;
    }
    .btnRech{
      background-color: #4e73de;
      color: #fff;
      padding: 7px 20px;
      transition: .4s ease;
    }
    .btnRech:hover{
      background-color: #fff;
      border: 2px solid #4e73de;
      color: #4e73de;
    }
    </style>
</head>
<body>
  
  {{----------------------- HEADER ---------------------------}}
  
<nav class="menu">

  <a href="#" class="nav-icon" aria-label="homepage" aria-current="page">
  <a href="#" class="nav-icon" id="forLogo" aria-label="homepage" aria-current="page">
    <img src="{{asset("img/landing_page/logo.png")}}" alt="Logo" class="logoImg">
    <span>Darkum</span>
  </a>

  <div class="main-navlinks">
    <button type="button" class="forMedia"  aria-label="Toggle Navigation" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <div class="navlinks-container">
      <a href="/" aria-current="page" class="btn">Home</a>
      <a href="{{route("vente")}}" class="btn">Vente</a>
      <a href="{{route("location")}}" class="btn">Location</a>
      <a href="contact" class="btn">Contact</a>
      <button class="nvAnnonce">Publier Une Annonce</button>
    </div>
  </div>

  <div class="nav-authentication">
    <a href="#" class="user-toggler" aria-label="Sign in page">
      <img src="{{asset("img/user.svg")}}" alt="user icon" />
    </a>
    <div class="sign">
      @guest
      <a href="{{ route('login') }}" class="signA">Sign in</a>
      <button type="button" class="loginBtn signB"><a href="{{ route('register') }}">Sign up</a></button>
      @endguest
      @auth
      <button type="button" class="loginBtn signB"><a href="/user">Dashboard</a></button>
      @endauth
    </div>
  </div>
  
</nav>



  
  @yield("content")
  
  


{{----------------------------- FOOTER ------------------------------------------}}

<footer class="footer">
  <div class="container">
    {{-- <div class="row"> --}}
      <div class="footer-col">
        <ul>
          <li class="footerLogo"><a href="#"><img src="{{asset("img/landing_page/logo.png")}}" width="80" height="100" alt="Logo"> <span>Darkum</span></a></li>
        </ul>
      </div>
      <div class="footer-col">
        <ul>
          <li><a href="#">Publier Une Annonce</a></li>
          <li><a href="#">Inscrivez-vous</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <ul>
          <li><a href="about">Qui sommes nous?</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="contact">Contactez-nous</a></li>
          <li><a href="privacy">Conditions d'utilisation</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
    {{-- </div> --}}
  </div>
  <div class="bottom-details">
    <div class="bottom_text">
      <span class="copyright_text">Copyright © 2023 <a href="/" class="darkum"> Darkum. </a>Tous droits réservés</span>
    </div>
  </div>
</footer>

  <script src="{{asset("js/landing_page/index.js")}}"></script>
  <script src="{{asset("js/landing_page/layout.js")}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  @yield("script")
</body>
</html>