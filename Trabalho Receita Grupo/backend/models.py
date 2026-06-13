from database import DB

class Fornecedor(DB.Model):

    __tablename__ = 'fornecedores'

    id = DB.Column(DB.Integer, primary_key=True)

    cnpj = DB.Column(DB.String(18), unique=True, nullable=False)

    razao_social = DB.Column(DB.String(255))

    nome_fantasia = DB.Column(DB.String(255))

    situacao_cadastral = DB.Column(DB.String(100))

    cnae_principal = DB.Column(DB.Text)

    endereco = DB.Column(DB.Text)

    cidade = DB.Column(DB.String(100))

    estado = DB.Column(DB.String(2))

    email = DB.Column(DB.String(255))

    telefone = DB.Column(DB.String(30))