// Ativar Links do Menu

const links = document.querySelectorAll(".header-menu a");

function ativarLink(link) {
  const url = location.href;
  const href = link.href;

  if (url.includes(href)) {
    link.classList.add("ativo");
  }
}

links.forEach(ativarLink);

// Ativar Itens do Orçamento

const parametros = new URLSearchParams(location.search);

function ativarProduto(parametro) {
  const elemento = document.getElementById(parametro);
  elemento.checked = true;
}

parametros.forEach(ativarProduto);

// Perguntas Frequentes

const perguntas = document.querySelectorAll(".perguntas button");

function ativarPergunta(event) {
  const pergunta = event.currentTarget;
  const constrols = pergunta.getAttribute("aria-controls");
  const resposta = document.getElementById(constrols);

  resposta.classList.toggle("ativa");
  const ativa = resposta.classList.contains("ativa");
  pergunta.setAttribute("aria-expanded", ativa);
}

function eventosPerguntas(pergunta) {
  pergunta.addEventListener("click", ativarPergunta);
}

perguntas.forEach(eventosPerguntas);

// Galeria de Bicicletas
const galeria = document.querySelectorAll(".bicicleta-imagem img");
const galeriaContainer = document.querySelector(".bicicleta-imagem");

function trocarImagem(event) {
  const img = event.currentTarget;
  // const media = matchMedia("(min-width: 1000px)").mathes;
  // if (media)
  if (window.innerWidth >= 937) {
    galeriaContainer.prepend(img);
  }
}

function eventosGaleria(img) {
  img.addEventListener("click", trocarImagem);
}

galeria.forEach(eventosGaleria);
