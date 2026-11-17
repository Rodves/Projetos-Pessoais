from datetime import datetime

FORMATO_DATA_HORA = "%d-%m-%Y %H:%M:%S"


class ContasIterador:
    def __init__(self, contas):
        self.contas = contas
        self._index = 0

    def __iter__(self):
        return self

    def __next__(self):
        if self._index >= len(self.contas):
            raise StopIteration

        conta = self.contas[self._index]
        self._index += 1
        return f"""\
            Agência:\t{conta.agencia}
            Número:\t\t{conta.numero}
            Titular:\t{conta.cliente.nome}
            Saldo:\t\tR$ {conta.saldo:.2f}
        """


class Cliente:
    def __init__(self, endereco):
        self.endereco = endereco
        self.contas = []
        self.indice_conta = 0

    def realizar_transacao(self, conta, transacao):
        """Aplica a regra de limite diário geral e delega o registro da transação."""
        if len(conta.historico.transacoes_do_dia()) >= conta.limite_transacoes:
            return False, f"Limite diário de {conta.limite_transacoes} transações excedido para hoje!"

        return transacao.registrar(conta)

    def adicionar_conta(self, conta):
        self.contas.append(conta)


class Conta:
    def __init__(self, numero, cliente, limite_transacoes=50):
        self._saldo = 0.0
        self._numero = numero
        self._agencia = "0001"
        self._cliente = cliente
        self._historico = Historico()
        self._limite_transacoes = limite_transacoes

    @classmethod
    def nova_conta(cls, cliente, numero):
        return cls(numero, cliente)

    @property
    def saldo(self):
        return self._saldo

    @saldo.setter
    def saldo(self, valor):
        self._saldo = float(valor)

    @property
    def numero(self):
        return self._numero

    @property
    def agencia(self):
        return self._agencia

    @property
    def cliente(self):
        return self._cliente

    @property
    def historico(self):
        return self._historico

    @property
    def limite_transacoes(self):
        return self._limite_transacoes

    def sacar(self, valor):
        """Executa a lógica de saque retornando (sucesso: bool, mensagem: str)."""
        saldo = self.saldo
        excedeu_saldo = valor > saldo

        if excedeu_saldo:
            return False, "Operação falhou! Você não tem saldo suficiente."
        elif valor > 0:
            self._saldo -= valor
            return True, "Saque realizado com sucesso!"
        else:
            return False, "Operação falhou! O valor informado é inválido."

    def depositar(self, valor):
        """Executa a lógica de depósito retornando (sucesso: bool, mensagem: str)."""
        if valor > 0:
            self._saldo += valor
            return True, "Depósito realizado com sucesso!"
        else:
            return False, "Operação falhou! O valor informado é inválido."


class Historico:
    def __init__(self):
        self._transacoes = []

    @property
    def transacoes(self):
        return self._transacoes

    def adicionar_transacao(self, transacao):
        self._transacoes.append(
            {
                "tipo": transacao.__class__.__name__,
                "valor": transacao.valor,
                "data": datetime.now().strftime(FORMATO_DATA_HORA),
            }
        )

    def gerar_relatorio(self, tipo_transacao=None):
        for transacao in self._transacoes:
            if (
                tipo_transacao is None
                or transacao["tipo"].lower() == tipo_transacao.lower()
            ):
                yield transacao

    def transacoes_do_dia(self, tipo_transacao=None):
        """Transações de hoje; com tipo_transacao, só as desse tipo (ex.: 'Saque')."""
        hoje = datetime.now().date()
        return [
            transacao
            for transacao in self.gerar_relatorio(tipo_transacao)
            if datetime.strptime(transacao["data"], FORMATO_DATA_HORA).date() == hoje
        ]
