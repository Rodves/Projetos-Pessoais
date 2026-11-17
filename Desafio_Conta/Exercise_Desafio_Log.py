import csv
import functools
import textwrap
from abc import ABC, abstractmethod
from datetime import datetime
from pathlib import Path

from Classes_Desafio import ContasIterador, Cliente, Conta, Historico

ROOT_PATH = Path(__file__).parent
ARQUIVO_LOG = ROOT_PATH / "log.txt"
ARQUIVO_CLIENTES = ROOT_PATH / "clientes.csv"
ARQUIVO_CONTAS = ROOT_PATH / "contas.csv"

CAMPOS_CLIENTE = ["cpf", "nome", "data_nascimento", "endereco"]
CAMPOS_CONTA = ["numero", "agencia", "cpf_cliente", "saldo"]

LIMITE_VALOR_SAQUE = 500.0      # Valor máximo permitido por saque (R$)
LIMITE_SAQUES_DIA = 3           # Quantidade máxima de saques permitida por dia
LIMITE_TRANSACOES_DIA = 50      # Limite geral de transações diárias (depósitos + saques)


# ---------------------------------------------------------------------------
# Modelos do Sistema Bancário
# ---------------------------------------------------------------------------
class PessoaFisica(Cliente):
    def __init__(self, nome, data_nascimento, cpf, endereco):
        super().__init__(endereco)
        self.nome = nome
        self.data_nascimento = data_nascimento
        self.cpf = cpf


class ContaCorrente(Conta):
    def __init__(
        self,
        numero,
        cliente,
        limite=LIMITE_VALOR_SAQUE,
        limite_saques=LIMITE_SAQUES_DIA,
        limite_transacoes=LIMITE_TRANSACOES_DIA,
    ):
        super().__init__(numero, cliente, limite_transacoes)
        self._limite = limite
        self._limite_saques = limite_saques

    @classmethod
    def nova_conta(
        cls,
        cliente,
        numero,
        limite=LIMITE_VALOR_SAQUE,
        limite_saques=LIMITE_SAQUES_DIA,
        limite_transacoes=LIMITE_TRANSACOES_DIA,
    ):
        return cls(numero, cliente, limite, limite_saques, limite_transacoes)

    def sacar(self, valor):
        """Aplica regras específicas de Conta Corrente (limite por saque e saques diários)."""
        saques_hoje = len(self.historico.transacoes_do_dia(Saque.__name__))

        excedeu_limite = valor > self._limite
        excedeu_saques = saques_hoje >= self._limite_saques

        if excedeu_limite:
            return False, f"Operação falhou! O valor de R$ {valor:.2f} excede o limite por saque de R$ {self._limite:.2f}."
        elif excedeu_saques:
            return False, f"Operação falhou! Limite de {self._limite_saques} saques diários já foi atingido hoje."
        else:
            return super().sacar(valor)

    def __str__(self):
        return f"""\
            Agência:\t{self.agencia}
            C/C:\t\t{self.numero}
            Titular:\t{self.cliente.nome}
            Saldo:\t\tR$ {self.saldo:.2f}
        """


class Transacao(ABC):
    @property
    @abstractmethod
    def valor(self):
        pass

    @abstractmethod
    def registrar(self, conta):
        pass


class Saque(Transacao):
    def __init__(self, valor):
        self._valor = valor

    @property
    def valor(self):
        return self._valor

    def registrar(self, conta):
        sucesso, mensagem = conta.sacar(self.valor)
        if sucesso:
            conta.historico.adicionar_transacao(self)
        return sucesso, mensagem


class Deposito(Transacao):
    def __init__(self, valor):
        self._valor = valor

    @property
    def valor(self):
        return self._valor

    def registrar(self, conta):
        sucesso, mensagem = conta.depositar(self.valor)
        if sucesso:
            conta.historico.adicionar_transacao(self)
        return sucesso, mensagem


# ---------------------------------------------------------------------------
# Decorador de Auditoria (Log de Transações com Detalhes)
# ---------------------------------------------------------------------------
def log_transacao(func):
    """
    Decorador que intercepta a execução da operação bancária para:
    1. Registrar o momento exato da operação (data e hora).
    2. Capturar o resultado detalhado (cliente, conta, valores ou motivos de falha).
    3. Persistir a linha de auditoria no arquivo log.txt.
    """
    @functools.wraps(func)
    def envelope(*args, **kwargs):
        momento = datetime.now().strftime("%d-%m-%Y %H:%M:%S")
        status = "OK"
        detalhes = ""
        try:
            resultado = func(*args, **kwargs)
            if isinstance(resultado, str):
                detalhes = f" | {resultado}"
            return resultado
        except Exception as erro:
            status = f"ERRO ({type(erro).__name__}: {erro})"
            raise
        finally:
            linha = f"{momento} | {func.__name__.upper()} | {status}{detalhes}"
            print(f"[LOG] {linha}")
            try:
                with open(ARQUIVO_LOG, "a", encoding="utf-8") as arquivo:
                    arquivo.write(linha + "\n")
            except OSError as erro_arquivo:
                print(f"@@@ Não foi possível gravar o log: {erro_arquivo} @@@")

    return envelope


# ---------------------------------------------------------------------------
# Persistência de Dados (Arquivos CSV)
# ---------------------------------------------------------------------------
def carregar_clientes():
    """Lê os clientes salvos no arquivo clientes.csv."""
    clientes = []
    if not ARQUIVO_CLIENTES.exists():
        return clientes

    with open(ARQUIVO_CLIENTES, "r", newline="", encoding="utf-8") as arquivo:
        for linha in csv.DictReader(arquivo):
            clientes.append(
                PessoaFisica(
                    nome=linha["nome"],
                    data_nascimento=linha["data_nascimento"],
                    cpf=linha["cpf"],
                    endereco=linha["endereco"],
                )
            )
    return clientes


def salvar_cliente(cliente):
    """Acrescenta um novo cliente no arquivo clientes.csv."""
    arquivo_novo = not ARQUIVO_CLIENTES.exists()
    with open(ARQUIVO_CLIENTES, "a", newline="", encoding="utf-8") as arquivo:
        escritor = csv.DictWriter(arquivo, fieldnames=CAMPOS_CLIENTE)
        if arquivo_novo:
            escritor.writeheader()
        escritor.writerow(
            {
                "cpf": cliente.cpf,
                "nome": cliente.nome,
                "data_nascimento": cliente.data_nascimento,
                "endereco": cliente.endereco,
            }
        )


def carregar_contas(clientes):
    """
    Carrega as contas cadastradas do contas.csv e as vincula aos respectivos clientes.
    Garante que contas e saldos não sejam perdidos ao reiniciar o programa.
    """
    contas = []
    if not ARQUIVO_CONTAS.exists():
        return contas

    with open(ARQUIVO_CONTAS, "r", newline="", encoding="utf-8") as arquivo:
        for linha in csv.DictReader(arquivo):
            cpf_cliente = linha["cpf_cliente"]
            cliente = filtrar_cliente(cpf_cliente, clientes)
            if cliente:
                conta = ContaCorrente(
                    numero=int(linha["numero"]),
                    cliente=cliente,
                    limite=LIMITE_VALOR_SAQUE,
                    limite_saques=LIMITE_SAQUES_DIA,
                    limite_transacoes=LIMITE_TRANSACOES_DIA,
                )
                conta.saldo = float(linha["saldo"])
                contas.append(conta)
                cliente.adicionar_conta(conta)
    return contas


def salvar_contas(contas):
    """Atualiza a base de contas e saldos no arquivo contas.csv."""
    with open(ARQUIVO_CONTAS, "w", newline="", encoding="utf-8") as arquivo:
        escritor = csv.DictWriter(arquivo, fieldnames=CAMPOS_CONTA)
        escritor.writeheader()
        for conta in contas:
            escritor.writerow(
                {
                    "numero": conta.numero,
                    "agencia": conta.agencia,
                    "cpf_cliente": conta.cliente.cpf,
                    "saldo": f"{conta.saldo:.2f}",
                }
            )


# ---------------------------------------------------------------------------
# Funções Auxiliares de Apoio ao Menu
# ---------------------------------------------------------------------------
def menu():
    texto_menu = """\n
    ================ MENU ================
    [d]\tDepositar
    [s]\tSacar
    [e]\tExtrato
    [nc]\tNova conta
    [lc]\tListar contas
    [nu]\tNovo usuário
    [q]\tSair
    => """
    return input(textwrap.dedent(texto_menu)).strip().lower()


def filtrar_cliente(cpf, clientes):
    clientes_filtrados = [cliente for cliente in clientes if cliente.cpf == cpf]
    return clientes_filtrados[0] if clientes_filtrados else None


def ler_valor(mensagem):
    """Lê um valor monetário digitado pelo usuário; devolve None se for inválido."""
    texto = input(mensagem).strip().replace(",", ".")
    try:
        valor = float(texto)
    except ValueError:
        print("\n@@@ Valor inválido! Digite apenas números válidos. @@@")
        return None

    if valor <= 0:
        print("\n@@@ O valor deve ser maior do que zero! @@@")
        return None
    return valor


def recuperar_conta_cliente(cliente):
    """Localiza a conta bancária do cliente para realizar operações."""
    if not cliente.contas:
        print("\n@@@ Cliente informado não possui nenhuma conta cadastrada! @@@")
        return None

    if len(cliente.contas) == 1:
        return cliente.contas[0]

    print("\nContas vinculadas a este cliente:")
    for conta in cliente.contas:
        print(f"\tC/C: {conta.numero} - Agência: {conta.agencia}")

    escolha = input("Informe o número da conta desejada: ").strip()
    for conta in cliente.contas:
        if str(conta.numero) == escolha:
            return conta

    print("\n@@@ Conta não encontrada! @@@")
    return None


def montar_extrato(historico: Historico) -> str:
    """Formata o extrato a partir de um Histórico de maneira legível."""
    linhas = [
        f"\n{transacao['data']} | {transacao['tipo']}:\n\tR$ {transacao['valor']:.2f}"
        for transacao in historico.gerar_relatorio()
    ]
    return "".join(linhas) if linhas else "Não foram realizadas movimentações até o momento."


# ---------------------------------------------------------------------------
# Operações Disponíveis no Menu
# ---------------------------------------------------------------------------
@log_transacao
def depositar(clientes, contas):
    cpf = input("Informe o CPF do cliente: ").strip()
    cliente = filtrar_cliente(cpf, clientes)

    if not cliente:
        print("\n@@@ Cliente não encontrado! @@@")
        return "Recusado - Cliente não encontrado"

    conta = recuperar_conta_cliente(cliente)
    if not conta:
        return "Recusado - Conta não encontrada"

    valor = ler_valor("Informe o valor do depósito: R$ ")
    if valor is None:
        return "Recusado - Valor inválido"

    sucesso, mensagem = cliente.realizar_transacao(conta, Deposito(valor))
    if sucesso:
        salvar_contas(contas)
        print(f"\n=== {mensagem} ===")
        return f"Sucesso - CPF: {cliente.cpf} - C/C: {conta.numero} - Valor: R$ {valor:.2f}"
    else:
        print(f"\n@@@ {mensagem} @@@")
        return f"Recusado - CPF: {cliente.cpf} - C/C: {conta.numero} - Motivo: {mensagem}"


@log_transacao
def sacar(clientes, contas):
    cpf = input("Informe o CPF do cliente: ").strip()
    cliente = filtrar_cliente(cpf, clientes)

    if not cliente:
        print("\n@@@ Cliente não encontrado! @@@")
        return "Recusado - Cliente não encontrado"

    conta = recuperar_conta_cliente(cliente)
    if not conta:
        return "Recusado - Conta não encontrada"

    valor = ler_valor("Informe o valor do saque: R$ ")
    if valor is None:
        return "Recusado - Valor inválido"

    sucesso, mensagem = cliente.realizar_transacao(conta, Saque(valor))
    if sucesso:
        salvar_contas(contas)
        print(f"\n=== {mensagem} ===")
        return f"Sucesso - CPF: {cliente.cpf} - C/C: {conta.numero} - Valor: R$ {valor:.2f}"
    else:
        print(f"\n@@@ {mensagem} @@@")
        return f"Recusado - CPF: {cliente.cpf} - C/C: {conta.numero} - Motivo: {mensagem}"


@log_transacao
def exibir_extrato(clientes):
    cpf = input("Informe o CPF do cliente: ").strip()
    cliente = filtrar_cliente(cpf, clientes)

    if not cliente:
        print("\n@@@ Cliente não encontrado! @@@")
        return "Recusado - Cliente não encontrado"

    conta = recuperar_conta_cliente(cliente)
    if not conta:
        return "Recusado - Conta não encontrada"

    print("\n================ EXTRATO ================")
    print(montar_extrato(conta.historico))
    print(f"\nSaldo Atual:\n\tR$ {conta.saldo:.2f}")
    print("==========================================")
    return f"Consulta - CPF: {cliente.cpf} - C/C: {conta.numero}"


@log_transacao
def criar_cliente(clientes):
    cpf = input("Informe o CPF (somente números): ").strip()
    cliente = filtrar_cliente(cpf, clientes)

    if cliente:
        print("\n@@@ Já existe cliente cadastrado com esse CPF! @@@")
        return f"Recusado - CPF {cpf} já cadastrado"

    nome = input("Informe o nome completo: ").strip()
    data_nascimento = input("Informe a data de nascimento (dd-mm-aaaa): ").strip()
    endereco = input(
        "Informe o endereço (logradouro, nro - bairro - cidade/sigla estado): "
    ).strip()

    cliente = PessoaFisica(
        nome=nome, data_nascimento=data_nascimento, cpf=cpf, endereco=endereco
    )

    clientes.append(cliente)
    salvar_cliente(cliente)

    print("\n=== Cliente cadastrado com sucesso! ===")
    return f"Sucesso - Cliente: {cliente.nome} - CPF: {cliente.cpf}"


@log_transacao
def criar_conta(numero_conta, clientes, contas):
    cpf = input("Informe o CPF do cliente: ").strip()
    cliente = filtrar_cliente(cpf, clientes)

    if not cliente:
        print("\n@@@ Cliente não encontrado! Fluxo de criação de conta encerrado. @@@")
        return "Recusado - Cliente não encontrado"

    conta = ContaCorrente.nova_conta(
        cliente=cliente,
        numero=numero_conta,
        limite=LIMITE_VALOR_SAQUE,
        limite_saques=LIMITE_SAQUES_DIA,
        limite_transacoes=LIMITE_TRANSACOES_DIA,
    )
    contas.append(conta)
    cliente.adicionar_conta(conta)
    salvar_contas(contas)

    print(f"\n=== Conta C/C {conta.numero} criada com sucesso para {cliente.nome}! ===")
    return f"Sucesso - C/C: {conta.numero} - Titular: {cliente.nome} (CPF: {cliente.cpf})"


@log_transacao
def listar_contas(contas):
    if not contas:
        print("\n@@@ Nenhuma conta cadastrada no momento! @@@")
        return "Consulta - Nenhuma conta cadastrada"

    for conta in ContasIterador(contas):
        print("=" * 60)
        print(textwrap.dedent(conta))
    return f"Consulta - Total de contas listadas: {len(contas)}"


# ---------------------------------------------------------------------------
# Ponto de Entrada da Aplicação
# ---------------------------------------------------------------------------
def main():
    # Carrega dados salvos em arquivo
    clientes = carregar_clientes()
    contas = carregar_contas(clientes)

    while True:
        opcao = menu()

        if opcao == "d":
            depositar(clientes, contas)

        elif opcao == "s":
            sacar(clientes, contas)

        elif opcao == "e":
            exibir_extrato(clientes)

        elif opcao == "nu":
            criar_cliente(clientes)

        elif opcao == "nc":
            numero_conta = len(contas) + 1
            criar_conta(numero_conta, clientes, contas)

        elif opcao == "lc":
            listar_contas(contas)

        elif opcao == "q":
            print("\nObrigado por utilizar nosso sistema bancário! Até logo.")
            break

        else:
            print("\n@@@ Opção inválida! Por favor, selecione uma opção válida do menu. @@@")


if __name__ == "__main__":
    main()
