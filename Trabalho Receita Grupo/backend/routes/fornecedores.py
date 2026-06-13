from flask import Blueprint, jsonify

from models import Fornecedor

from database import DB

import requests

fornecedores_bp = Blueprint('fornecedores', __name__)

@fornecedores_bp.route('/fornecedor/<cnpj>', methods=['GET'])

def consultar_cnpj(cnpj):

    url = f'https://brasilapi.com.br/api/cnpj/v1/{cnpj}'

    resposta = requests.get(url)

    if resposta.status_code != 200:

        return jsonify({'erro': 'CNPJ não encontrado'}), 404

    dados = resposta.json()

    fornecedor = Fornecedor(

        cnpj=dados.get('cnpj'),

        razao_social=dados.get('razao_social'),

        nome_fantasia=dados.get('nome_fantasia'),

        situacao_cadastral=dados.get('descricao_situacao_cadastral'),

        cnae_principal=dados.get('cnae_fiscal_descricao'),

        endereco=f"{dados.get('logradouro')} - {dados.get('bairro')}",

        cidade=dados.get('municipio'),

        estado=dados.get('uf'),

        email=dados.get('email'),

        telefone=dados.get('ddd_telefone_1')

    )

    existe = Fornecedor.query.filter_by(cnpj=fornecedor.cnpj).first()

    if not existe:

        DB.session.add(fornecedor)

        DB.session.commit()

    return jsonify({

        'cnpj': fornecedor.cnpj,

        'razao_social': fornecedor.razao_social,

        'situacao': fornecedor.situacao_cadastral,

        'cidade': fornecedor.cidade,

        'estado': fornecedor.estado

    })

@fornecedores_bp.route('/fornecedores', methods=['GET'])

def listar_fornecedores():

    fornecedores = Fornecedor.query.all()

    lista = []

    for f in fornecedores:

        lista.append({

            'id': f.id,

            'cnpj': f.cnpj,

            'razao_social': f.razao_social,

            'situacao': f.situacao_cadastral,

            'cidade': f.cidade,

            'estado': f.estado

        })

    return jsonify(lista)