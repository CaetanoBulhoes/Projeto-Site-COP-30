<?php
require_once '../scripts_e_outros/funcoes.php';
require_once '../scripts_e_outros/config.php';
precisa_logar();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>EcoBélem — Produtos</title>
  <link rel="stylesheet" href="../style/style_Eco.css" />
  <link rel="stylesheet" href="../style/style_Eco2.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

  <!-- BARRA SUPERIOR -->
  <div class="top-bar">
    <p>Bem-vindo(a) à EcoBélem 🌿 — Artesanato sustentável do Pará</p>
  </div>

  <!-- CABEÇALHO -->
  <header class="site-header">
    <div class="header-left">
    
      <img src="/mnt/data/A_collection_of_four_eco-friendly_branding_logo_de.png" alt="EcoBélem" class="logo">
    </div>


    <div class="header-right">
      <!-- ícone da pessoinha para login -->
     <button class="icon-btn" id="loginBtn" aria-label="Login">
    <svg class="user-outline" width="32" height="32" viewBox="0 0 24 24">
        <circle cx="12" cy="7" r="5" stroke="white" stroke-width="2" fill="none"/>
        <path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke="white" stroke-width="2" fill="none"/>
    </svg>
  </button>
  
      <!-- botão do carrinho -->
      <button id="cart-btn" class="cart-btn" aria-label="Abrir carrinho">
    <svg class="cart-icon" width="24" height="24" viewBox="0 0 24 24">
        <circle cx="9" cy="20" r="1.5" stroke-width="2" fill="none"/>
        <circle cx="17" cy="20" r="1.5" stroke-width="2" fill="none"/>
        <path d="M3 3h2l3 12h10l3-8H6" stroke-width="2" fill="none"/>
    </svg>
    <span id="cart-count">0</span>
      </button>

      <!-- Botão de Logout -->
  <a href="../scripts_e_outros/deslogar.php" class="logout-btn" >
      <i class="fa-solid fa-right-from-bracket"></i> Sair
  </a>

    </div>
  </header>

  <!-- CARROSSEL SIMPLES -->
  <section class="hero">
    <div class="carousel">
      <div class="slides" src="...">
      <img src="../assets/../assets/Imagens/Carrossel/banner1.jpg.jpeg"carrossel 1" class="slide">
      <img src="../assets/Imagens/Carrossel/banner2.jpg.jpeg" alt="carrossel 2" class="slide">
      <img src="../assets/Imagens/Carrossel/banner3.jpg.jpeg" alt="carrosel 3" class="slide">
      <img src="../assets/Imagens/Carrossel/banner4.jpg.jpeg" alt="carrosel 4" class="slide">
    </div>
    </div>

    <div class="hero-text">
      <h1>Natureza e arte se encontram</h1>
      <p>Produtos sustentáveis e feitos à mão — inspirados na Amazônia.</p>
    </div>
  </section>

  
  <main class="produtos-section">
    <h2>Nossos Produtos</h2>

    <div class="product-grid">
      <article class="product-card" data-id="1" data-name="Cesto de Palha" data-price="49.90">
        <img src="../assets/Imagens/Produtos/img-produto1.jpg.jpeg" alt="Cesto de Palha">
        <h3>Cesto de Palha</h3>
        <p class="price">R$ 30,00</p>
        <button class="add-btn">Adicionar</button>
      </article>


      <article class="product-card" data-id="2" data-name="Vaso de Barro" data-price="59.90">
        <img src="../assets/Imagens/Produtos/img-produto2.jpg.jpeg" alt="Vaso de Barro">
        <h3>Vaso de Barro</h3>
        <p class="price">R$ 59,90</p>
        <button class="add-btn">Adicionar</button>
      </article>

      
      <article class="product-card" data-id="3" data-name="Tapete de Fibra" data-price="89.90">
        <img src="../assets/Imagens/Produtos/img-produto3.jpg.jpeg" alt="Tapete de Fibra">
        <h3>Tapete de Fibra</h3>
        <p class="price">R$ 89,90</p>
        <button class="add-btn">Adicionar</button>
      </article>

  
      <article class="product-card" data-id="4" data-name="Vela Artesanal" data-price="29.90">
        <img src="../assets/Imagens/Produtos/img-produto4.jpg.jpeg" alt="Vela Artesanal">
        <h3>Vela Artesanal</h3>
        <p class="price">R$ 29,90</p>
        <button class="add-btn">Adicionar</button>
      </article>

      
      <article class="product-card" data-id="5" data-name="Sabonete Natural" data-price="15.00">
        <img src="../assets/Imagens/Produtos/img-produto5.jpg.jpeg" alt="Sabonete Natural">
        <h3>Sabonete Natural</h3>
        <p class="price">R$ 15,00</p>
        <button class="add-btn">Adicionar</button>
      </article>

      
      <article class="product-card" data-id="6" data-name="Óleo de Andiroba" data-price="40.00">
        <img src="../assets/Imagens/Produtos/img-produto6.jpg.jpeg" alt="Óleo de Andiroba">
        <h3>Manta</h3>
        <p class="price">R$ 40,00</p>
        <button class="add-btn">Adicionar</button>
      </article>

      
      <article class="product-card" data-id="7" data-name="Pulseira de Semente" data-price="25.00">
        <img src="../assets/Imagens/Produtos/img-produto7.jpg.jpeg" alt="Pulseira de Semente">
        <h3>Pulseira de Semente</h3>
        <p class="price">R$ 25,00</p>
        <button class="add-btn">Adicionar</button>
      </article>

      
      <article class="product-card" data-id="8" data-name="Ecobag" data-price="90.00">
        <img src="../assets/Imagens/Produtos/img-produto8.jpg.jpeg" alt="Ecobag">
        <h3>Ecobag</h3>
        <p class="price">R$ 40,00</p>
        <button class="add-btn">Adicionar</button>
      </article>

      
      <article class="product-card" data-id="9" data-name="Chaveiro Regional" data-price="10.00">
        <img src="../assets/Imagens/Produtos/img-produto9.jpg.jpeg" alt="Chaveiro Regional">
        <h3>Chaveiro</h3>
        <p class="price">R$ 10,00</p>
        <button class="add-btn">Adicionar</button>
      </article>

    
      <article class="product-card" data-id="10" data-name="Colar Açaí Verde e Jacarandá" data-price="55.00">
        <img src="../assets/Imagens/Produtos/img-produto10.jpg.jpeg" alt="Colar Açaí Verde e Jacarandá">
        <h3>Colar Açaí Verde e Jacarandá</h3>
        <p class="price">R$ 55,00</p>
        <button class="add-btn">Adicionar</button>
      </article>

      
      <article class="product-card" data-id="11" data-name="Quadro Bordado" data-price="120.00">
        <img src="../assets/Imagens/Produtos/img-produto11.jpg.jpeg" alt="Quadro Bordado">
        <h3>Quadro Bordado</h3>
        <p class="price">R$ 120,00</p>
        <button class="add-btn">Adicionar</button>
      </article>

      
      <article class="product-card" data-id="12" data-name="Porta Copos de Madeira" data-price="30.00">
        <img src="../assets/Imagens/Produtos/img-produto12.jpg.jpeg" alt="Porta Copos de Madeira">
        <h3>Porta Copos de Madeira</h3>
        <p class="price">R$ 30,00</p>
        <button class="add-btn">Adicionar</button>
      </article>

    </div>
  </main>

  
  <div id="cart-modal" class="cart-modal" aria-hidden="true">
    <div class="cart-content">
      <button class="close-cart" id="close-cart">×</button>
      <h2>Seu Carrinho</h2>

      <div id="cart-items" class="cart-items">
    
      </div>

      <div class="frete-area">
        <input id="cepInput" type="text" placeholder="Digite seu CEP (somente números)" maxlength="8" />
        <button id="calcFreteBtn">Calcular frete</button>
        <p id="freteInfo">Frete: R$ <span id="freteValue">0.00</span></p>
      </div>

      <div class="cart-summary">
        <p>Subtotal: R$ <span id="subtotal">0.00</span></p>
        <p>Total: R$ <span id="total">0.00</span></p>
        <button id="checkoutBtn" class="checkout-btn">Finalizar compra</button>
      </div>
    </div>
  </div>

  <div id="overlay" class="overlay"></div>

  <footer class="site-footer">
    <p>© 2025 EcoBélem — Sustentabilidade e arte</p>
  </footer>

  <script src="../scripts_e_outros/script_Eco.js"></script>
  <script src="../scripts_e_outros/script_Eco2.js"></script>
</body>
</html>


