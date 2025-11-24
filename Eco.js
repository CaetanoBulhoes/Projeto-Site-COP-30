// carrinho modal com cálculo de frete simples e carregamento básico

let cart = [];

const cartBtn = document.getElementById('cart-btn');
const cartCount = document.getElementById('cart-count');
const cartModal = document.getElementById('cart-modal');
const overlay = document.getElementById('overlay');
const closeCart = document.getElementById('close-cart');
const cartItemsWrap = document.getElementById('cart-items');
const subtotalEl = document.getElementById('subtotal');
const totalEl = document.getElementById('total');
const checkoutBtn = document.getElementById('checkoutBtn');
const cepInput = document.getElementById('cepInput');
const calcFreteBtn = document.getElementById('calcFreteBtn');
const freteValueEl = document.getElementById('freteValue');

// abre/fecha modal
function openCart(){
  cartModal.classList.add('open');
  overlay.style.display = 'block';
  overlay.classList.add('overlay');
  renderCart();
}
function closeCartFn(){
  cartModal.classList.remove('open');
  overlay.style.display = 'none';
}

// eventos
cartBtn.addEventListener('click', openCart);
closeCart.addEventListener('click', closeCartFn);
overlay.addEventListener('click', closeCartFn);

// adicionar ao carrinho
document.querySelectorAll('.add-btn').forEach(btn=>{
  btn.addEventListener('click', (e)=>{
    const card = e.target.closest('.product-card');
    const id = card.dataset.id;
    const name = card.dataset.name || card.querySelector('h3').innerText;
    const price = parseFloat(card.dataset.price || card.querySelector('.price').innerText.replace('R$','').replace(',','.'));
    const img = card.querySelector('img').getAttribute('src');
    addToCart({id,name,price,img});
  });
});

function addToCart(item){
  const found = cart.find(i=>i.id === item.id);
  if(found){
    found.qty += 1;
  } else {
    cart.push({...item, qty:1});
  }
  updateCartCount();
  renderCart();
}

// remove item do carrinho
function removeFromCart(id){
  cart = cart.filter(i=>i.id !== id);
  updateCartCount();
  renderCart();
}

// alterar quantidade
function changeQty(id, delta){
  const it = cart.find(i=>i.id === id);
  if(!it) return;
  it.qty += delta;
  if(it.qty < 1) it.qty = 1;
  renderCart();
  updateCartCount();
}

// atualiza contador no ícone
function updateCartCount(){
  const totalQty = cart.reduce((s,i)=>s + i.qty, 0);
  cartCount.textContent = totalQty;
}

// renderiza itens no modal
function renderCart(){
  cartItemsWrap.innerHTML = '';
  if(cart.length === 0){
    cartItemsWrap.innerHTML = '<p>Seu carrinho está vazio.</p>';
    subtotalEl.textContent = '0.00';
    totalEl.textContent = '0.00';
    freteValueEl.textContent = '0.00';
    return;
  }

  cart.forEach(item=>{
    const div = document.createElement('div');
    div.className = 'cart-item';
    div.innerHTML = `
      <img src="${item.img}" alt="${item.name}" />
      <div class="item-info">
        <h4>${item.name}</h4>
        <p>R$ ${item.price.toFixed(2)}</p>
        <div class="qty-controls">
          <button onclick="changeQty('${item.id}', -1)">-</button>
          <span>${item.qty}</span>
          <button onclick="changeQty('${item.id}', 1)">+</button>
          <button style="margin-left:8px;color:#c33;background:transparent;border:0;cursor:pointer" onclick="removeFromCart('${item.id}')">Remover</button>
        </div>
      </div>
    `;
    cartItemsWrap.appendChild(div);
  });

  // subtotal + total
  const subtotal = cart.reduce((s,i)=> s + (i.price * i.qty), 0);
  subtotalEl.textContent = subtotal.toFixed(2);
  const frete = parseFloat(freteValueEl.textContent || '0') || 0;
  totalEl.textContent = (subtotal + frete).toFixed(2);
}

// calcular frete simples por CEP
function calcularFretePorCep(cep){
  if(!cep || cep.length < 2) return 20;
  const prefix = cep.slice(0,2);
  let frete = 20;
  if(prefix === '66' || prefix === '67'){ frete = 10; } // Pará
  else if(['68','69'].includes(prefix)){ frete = 15; } // Norte
  else if(['01','02','03','04','05','06','07','08','09'].includes(prefix)){ frete = 25; } // exempl.
  else { frete = 20; }
  return frete;
}

// botão calcular frete
calcFreteBtn.addEventListener('click', ()=>{
  const cep = (cepInput.value || '').trim();
  if(cep.length < 8){
    alert('Digite um CEP válido (8 números).');
    return;
  }
  const frete = calcularFretePorCep(cep);
  freteValueEl.textContent = frete.toFixed(2);
  const subtotal = cart.reduce((s,i)=> s + (i.price * i.qty), 0);
  subtotalEl.textContent = subtotal.toFixed(2);
  totalEl.textContent = (subtotal + frete).toFixed(2);
});

// finalizar compra (simulação)
checkoutBtn.addEventListener('click', ()=>{
  if(cart.length === 0) { alert('Seu carrinho está vazio.'); return; }
  alert('Simulação: compra finalizada. Implementar gateway de pagamento real para produção.');
  cart = [];
  updateCartCount();
  renderCart();
  closeCartFn();
});

let index = 0;

function mudarSlide() {
    const slides = document.querySelectorAll(".slide");
    index++;

    if (index >= slides.length) {
        index = 0;
    }

    document.querySelector(".slides").style.transform =
        `translateX(${-index * 100}%)`;
}

setInterval(mudarSlide, 3000);