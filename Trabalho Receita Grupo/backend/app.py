from flask import Flask

from flask_cors import CORS #Permite que front-end faça requisições para o back-end

from database import DB # Importa a instância do banco de dados configurada no arquivo database.py

from routes.fornecedores import fornecedores_bp # Blueprint serve para organizar as rotas em arquivos separados

app = Flask(__name__)

app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://postgres:1234@localhost:5432/compliance_fornecedores'

app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

DB.init_app(app)

CORS(app)

# Registra o Blueprint de fornecedores
# Todas as rotas criadas em fornecedores_bp serão adicionadas ao sistema
app.register_blueprint(fornecedores_bp)

with app.app_context():

    DB.create_all()

if __name__ == '__main__':

    app.run(host='0.0.0.0', port=5000, debug=True)

#Quando rodar o servidor coloque esse link no navegador"http://127.0.0.1:5000/fornecedor/19131243000197", ele pega da página BrasilAPI 
# ou se quiser pegar só do banco rode este"http://localhost:5000/fornecedores" se aparecer [],significa que está certo, é pq a tabela do banco não possui dados