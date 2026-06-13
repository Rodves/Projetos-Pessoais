async function consultarFornecedor() {

    const cnpj = document.getElementById('cnpj').value;

    const resposta = await fetch(
        `http://127.0.0.1:5000/fornecedor/${cnpj}`
    );

    const dados = await resposta.json();

    document.getElementById('resultado').innerHTML = `
        <p><strong>Empresa:</strong> ${dados.razao_social}</p>
        <p><strong>Situação:</strong> ${dados.situacao}</p>
        <p><strong>Cidade:</strong> ${dados.cidade}</p>
    `;
}

async function listarFornecedores() {

    const resposta = await fetch(
        'http://127.0.0.1:5000/fornecedores'
    );

    const fornecedores = await resposta.json();

    const tabela = document.getElementById(
        'tabela-fornecedores'
    );

    tabela.innerHTML = '';

    fornecedores.forEach(f => {

        tabela.innerHTML += `
            <tr>
                <td>${f.cnpj}</td>
                <td>${f.razao_social}</td>
                <td>${f.situacao}</td>
                <td>${f.cidade}</td>
            </tr>
        `;
    });
}