from abc import ABC, abstractmethod

# Classe abstrata para representar um carro com atributos base
class Carro(ABC):
    # Inicializa o carro com aceleração máxima, cor e valor do modelo
    def __init__(self, aceleraçao_maxima: float, cor: str, valor_modelo: float):
        # Atributo privado para armazenar aceleração máxima do carro
        self._aceleraçao_maxima = aceleraçao_maxima
        # Atributo privado para cor do carro
        self._cor = cor
        # Atributo privado para valor do modelo
        self._valor_modelo = valor_modelo
        
    # Método para representar o carro como string (legível)
    def __str__(self):
        return f"Carro(aceleraçao_maxima={self._aceleraçao_maxima}, cor={self._cor}, valor_modelo={self._valor_modelo})"

    # Método para representar o carro como string para debug (usada em console)
    def __repr__(self):
        return f"Carro(aceleraçao_maxima={self._aceleraçao_maxima}, cor={self._cor}, valor_modelo={self._valor_modelo})"
    
    # Property para obter a cor do carro
    @property
    def cor(self):
        return self._cor
    
    # Setter para modificar a cor do carro
    @cor.setter
    def cor(self, cor):
        self._cor = cor
    
    # Property para obter a aceleração máxima
    @property
    def aceleraçao_maxima(self):
        return self._aceleraçao_maxima
    
    # Setter para modificar a aceleração máxima
    @aceleraçao_maxima.setter
    def aceleraçao_maxima(self, aceleraçao_maxima):
        self._aceleraçao_maxima = aceleraçao_maxima
    
    # Property para obter o valor do modelo
    @property
    def valor_modelo(self):
        return self._valor_modelo

# Classe SUV que herda de Carro com valor pré-definido
class SUV(Carro):
    # Inicializa SUV com aceleração máxima e cor, valor fixo em 70000
    def __init__(self, aceleraçao_maxima: float, cor: str):
        super().__init__(aceleraçao_maxima, cor, 70000)

# Classe Sedan que herda de Carro com valor pré-definido
class Sedan(Carro):
    # Inicializa Sedan com aceleração máxima e cor, valor fixo em 85000
    def __init__(self, aceleraçao_maxima: float, cor: str):
        super().__init__(aceleraçao_maxima, cor, 85000)

# Classe Hatch que herda de Carro com valor pré-definido
class Hatch(Carro):
    # Inicializa Hatch com aceleração máxima e cor, valor fixo em 80000
    def __init__(self, aceleraçao_maxima: float, cor: str):
        super().__init__(aceleraçao_maxima, cor, 80000)

# Classe para gerenciar a escolha de motor
class Motor:
    # Inicializa motor e seu percentual de acréscimo no valor
    def __init__(self):
        # Armazena o tipo de motor escolhido
        self.motor = ""
        # Percentual de acréscimo do motor no valor total
        self.percentual_acrescimo = 0.0

    # Método para o usuário escolher o tipo de motor
    def escolher_tipo(self):
        # Exibe as opções de motor disponíveis
        print("Tipos de Motor e seus Valores:")
        print("1.3 == 5% de acrescimo do valor total")
        print("1.8 == 10% de acréscimo do valor total") 
        print("2.0 == 15% de acréscimo do valor total")
        
        # Recebe a entrada do usuário
        opcao = input("Informe a opção desejada (1/2/3): ")
        
        # Verifica qual opção foi escolhida e define o motor e percentual
        if opcao == "1":
            self.motor = "1.3"
            self.percentual_acrescimo = 0.05
        elif opcao == "2":
            self.motor = "1.8" 
            self.percentual_acrescimo = 0.10
        elif opcao == "3":
            self.motor = "2.0"
            self.percentual_acrescimo = 0.15
        else:
            # Se opção inválida, usa motor padrão
            print("Opção inválida! Usando motor padrão 1.3")
            self.motor = "1.3"
            self.percentual_acrescimo = 0.05

# Classe para gerenciar os kits opcionais do carro
class Opcional:
    # Inicializa lista de kits opcionais e seu valor total
    def __init__(self):
        # Lista que armazenará os kits escolhidos
        self.kits = []
        # Valor total dos kits opcionais
        self.valor_total_kits = 0.0

    # Método para o usuário escolher kits opcionais
    def escolher_opcionais(self):
        # Loop infinito até o usuário decidir não escolher mais kits
        while True:
            # Pergunta se deseja escolher opcionais
            escolha = input("Deseja escolher algum kit opcional? (s/n): ").lower()
            if escolha == "n":
                # Sai do loop se escolher "não"
                break
            elif escolha == "s":
                # Exibe opções de kits
                print("Qual kit deseja escolher:")
                print("1 - Marcha")
                print("2 - Roda de Liga Leve") 
                print("3 - Trio Elétrico")
                
                # Recebe a escolha do kit
                opcao = input("Digite a opção (1/2/3): ")
                
                # Opção 1: Tipo de Marcha
                if opcao == "1":
                    # Pergunta se marcha automática ou manual
                    marcha = input("Deseja Marcha automatica ou manual? ").lower()
                    if marcha == "automatica":
                        # Verifica se já possui marcha automática
                        if "Marcha automatica" != self.kits:
                            # Adiciona marcha automática com valor 1400
                            self.kits.append("Marcha automática")
                            self.valor_total_kits += 1400
                            print("Marcha automática adicionada!")
                        else:
                            # Avisa que já possui
                            print("Já possui Marcha automática na lista")
                    else:
                        # Verifica se já possui marcha manual
                        if "Marcha manual" != self.kits:
                            # Adiciona marcha manual com valor 1200
                            self.kits.append("Marcha manual")
                            self.valor_total_kits += 1200
                            print("Marcha manual adicionada!")
                        else:
                            # Avisa que já possui
                            print("Já possui Marcha manual na lista")
                            
                # Opção 2: Roda de Liga Leve
                elif opcao == "2":
                    # Verifica se já possui roda de liga leve
                    if "Roda de Liga Leve" != self.kits:
                        # Adiciona roda de liga leve com valor 2200
                        self.kits.append("Roda de Liga Leve")
                        self.valor_total_kits += 2200
                        print("Roda de Liga Leve adicionada!")
                    else:
                        # Avisa que já possui
                        print("Já possui Roda de Liga Leve na lista")
                        
                # Opção 3: Trio Elétrico
                elif opcao == "3":
                    # Verifica se já possui trio elétrico
                    if "Trio Elétrico" != self.kits:
                        # Adiciona trio elétrico com valor 3000
                        self.kits.append("Trio Elétrico")
                        self.valor_total_kits += 3000
                        print("Trio Elétrico adicionado!")
                    else:
                        # Avisa que já possui
                        print("Já possui Trio Elétrico na lista")
                else:
                    # Se opção inválida
                    print("Opção inválida!")
            else:
                # Se entrada não é 's' ou 'n'
                print("Digite 's' para sim ou 'n' para não")

# Função para calcular o valor total do carro
def calcular_valor_total(valor_modelo: float, percentual_acrescimo: Motor, opcional: Opcional):
    # Obtém o percentual de acréscimo do motor
    valor_motor = motor.percentual_acrescimo
    # Calcula: valor_modelo * (1 + percentual_acrescimo) + valor_opcionais
    total = valor_modelo * valor_motor + opcional.valor_total_kits
    return total

# === PROGRAMA PRINCIPAL ===
print("===== CONFIGURADOR DE CARRO =====")

# Escolhe o tipo de carro desejado
carro_tipo = input("Informe qual carro você gostaria de comprar (Sedan/SUV/Hatch): ").title()

# Cria instância do carro escolhido
if carro_tipo == "Sedan":
    modelo = Sedan(200, "Vermelho")
elif carro_tipo == "Suv":
    modelo = SUV(180, "Preto")
else: 
    modelo = Hatch(220, "Branco")

# Cria instância de Motor e permite escolher o tipo
motor = Motor()
motor.escolher_tipo()

# Cria instância de Opcional e permite escolher kits
opcional = Opcional()
opcional.escolher_opcionais()

# Calcula o valor total da compra
total = calcular_valor_total(modelo.valor_modelo, motor, opcional)

# Exibe o resumo da compra
print("\n===== RESUMO DA COMPRA =====")
print(f"Carro: {carro_tipo}")
print(f"Cor: {modelo.cor}")
print(f"Aceleração máxima: {modelo.aceleraçao_maxima} km/h")
print(f"Motor: {motor.motor}")
print(f"Kits: {', '.join(opcional.kits) if opcional.kits else 'Nenhum'}")
print(f"Valor do modelo: R$ {modelo.valor_modelo:,.2f}")
print(f"Acréscimo do motor: R$ {motor.percentual_acrescimo:,.2f}")
print(f"Valor dos opcionais: R$ {opcional.valor_total_kits:,.2f}")
print(f"VALOR TOTAL: R$ {total:,.2f}")
