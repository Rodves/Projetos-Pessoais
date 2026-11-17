document.addEventListener('DOMContentLoaded',()=>{

    const urlParams = new URLSearchParams(window.location.search);

    const veiculoId = urlParams.get('id');

    if(!veiculoId){
        window.location.href = '../index.php';
        return;

    }

    fetch('/Trabalho_DW/php/api_le_catalogo.php')

        .then(response =>response.json())

        .then(data =>{

            const veiculo = data.veiculo.find(v => String(v.id) === String(veiculoId));

            if(veiculo){

                popularPagina(veiculo);


            }else{

                document.getElementById('detalhe-lista').innerHTML ='<li><h2>Veículo não encontrado.</h2></li>'; 

            }
        })
        .catch(error =>{

            console.error('Erro ao buscar dados do veículo:>', error);
            document.getElementById('detalhe-lista').innerHTML = '<li><h2>Erro ao carregar dados.</h2></li>';



        })



})

function popularPagina(veiculo){

    const imagem = document.getElementById('detalhe-imagem');
    const lista = document.getElementById('detalhe-lista');
    const linkComprar = document.getElementById('link-comprar');

    imagem.src = '../' + veiculo.foto; 
    imagem.alt = `Foto de ${veiculo.modelo}`;

    const precoFormatado = Number(veiculo.preco).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

    lista.innerHTML = `
        <h2 id="caracteristicas">Características do Veículo</h2>
        <div class="crc-grid">
            <div class="crc-item"><strong>Marca:</strong> <span>${veiculo.marca}</span></div>
            <div class="crc-item"><strong>Modelo:</strong> <span>${veiculo.modelo}</span></div>
            <div class="crc-item"><strong>Ano:</strong> <span>${veiculo.ano}</span></div>
            <div class="crc-item"><strong>Cor:</strong> <span>${veiculo.cor}</span></div>
            <div class="crc-item"><strong>Quilometragem:</strong> <span>${veiculo.quilometragem} km</span></div>
            <div class="crc-item"><strong>Combustível:</strong> <span>${veiculo.combustvel}</span></div>
            <div class="crc-item"><strong>Câmbio:</strong> <span>${veiculo.cmbio}</span></div>
            <div class="crc-item preco-item"><strong>Preço:</strong> <span class="destaque-preco">${precoFormatado}</span></div>
        </div>
        <div class="descricao-bloco">
            <strong>Descrição:</strong>
            <p class="p-descricao">${veiculo.descricao}</p>
        </div>
    `;

    
    linkComprar.href = `compra.php?id=${veiculo.id}`; 

} 
