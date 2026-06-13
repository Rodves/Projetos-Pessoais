from abc import ABC, abstractmethod

class Carro(ABC):
    def __init__(self, aceleraçao_maxima: float, cor: str, valor_modelo: float):
        self._aceleraçao_maxima = aceleraçao_maxima
        self._cor = cor
        self._valor_modelo = valor_modelo
        
    def __str__(self):
        return f"Carro(aceleraçao_maxima={self._aceleraçao_maxima}, cor={self._cor}, valor_modelo={self._valor_modelo})"

    def __repr__(self):
        return f"Carro(aceleraçao_maxima={self._aceleraçao_maxima}, cor={self._cor}, valor_modelo={self._valor_modelo})"
    
    @property
    def cor(self):
        return self._cor
    
    @cor.setter
    def cor(self, cor):
        self._cor = cor
    
    @property
    def aceleraçao_maxima(self):
        return self._aceleraçao_maxima
    
    @aceleraçao_maxima.setter
    def aceleraçao_maxima(self, aceleraçao_maxima):
        self._aceleraçao_maxima = aceleraçao_maxima
    
    @property
    def valor_modelo(self):
        return self._valor_modelo

class SUV(Carro):
    def __init__(self, aceleraçao_maxima: float, cor: str):
        super().__init__(aceleraçao_maxima, cor, 70000)

class Sedan(Carro):
    def __init__(self, aceleraçao_maxima: float, cor: str):
        super().__init__(aceleraçao_maxima, cor, 85000)

class Hatch(Carro):
    def __init__(self, aceleraçao_maxima: float, cor: str):
        super().__init__(aceleraçao_maxima, cor, 80000)

class Motor:
    def __init__(self):
        self.motor = ""
        self.percentual_acrescimo = 0.0

    def escolher_tipo(self):
        print("Tipos de Motor e seus Valores:")
        print("1.3 == 5% de acrescimo do valor total")
        print("1.8 == 10% de acréscimo do valor total") 
        print("2.0 == 15% de acréscimo do valor total")
        
        opcao = input("Informe a opção desejada (1/2/3): ")
        
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
            print("Opção inválida! Usando motor padrão 1.3")
            self.motor = "1.3"
            self.percentual_acrescimo = 0.05

class Opcional:
    def __init__(self):
        self.kits = []
        self.valor_total_kits = 0.0

    def escolher_opcionais(self):
        while True:
            escolha = input("Deseja escolher algum kit opcional? (s/n): ").lower()
            if escolha == "n":
                break
            elif escolha == "s":
                print("Qual kit deseja escolher:")
                print("1 - Marcha")
                print("2 - Roda de Liga Leve") 
                print("3 - Trio Elétrico")
                
                opcao = input("Digite a opção (1/2/3): ")
                
                if opcao == "1":
                    marcha = input("Deseja Marcha automatica ou manual? ").lower()
                    if marcha == "automatica":
                        if "Marcha automatica" != self.kits:
                            self.kits.append("Marcha automática")
                            self.valor_total_kits += 1400
                            print("Marcha automática adicionada!")
                        else:
                            print("Já possui Marcha automática na lista")
                    else:
                        if "Marcha manual" != self.kits:
                            self.kits.append("Marcha manual")
                            self.valor_total_kits += 1200
                            print("Marcha manual adicionada!")
                        else:
                            print("Já possui Marcha manual na lista")
                            
                elif opcao == "2":
                    if "Roda de Liga Leve" != self.kits:
                        self.kits.append("Roda de Liga Leve")
                        self.valor_total_kits += 2200
                        print("Roda de Liga Leve adicionada!")
                    else:
                        print("Já possui Roda de Liga Leve na lista")
                        
                elif opcao == "3":
                    if "Trio Elétrico" != self.kits:
                        self.kits.append("Trio Elétrico")
                        self.valor_total_kits += 3000
                        print("Trio Elétrico adicionado!")
                    else:
                        print("Já possui Trio Elétrico na lista")
                else:
                    print("Opção inválida!")
            else:
                print("Digite 's' para sim ou 'n' para não")

def calcular_valor_total(valor_modelo: float, percentual_acrescimo: Motor, opcional: Opcional):
    valor_motor = motor.percentual_acrescimo
    total = valor_modelo * valor_motor + opcional.valor_total_kits
    return total

# Programa principal
print("===== CONFIGURADOR DE CARRO =====")

# Escolha do carro
carro_tipo = input("Informe qual carro você gostaria de comprar (Sedan/SUV/Hatch): ").title()

if carro_tipo == "Sedan":
    modelo = Sedan(200, "Vermelho")
elif carro_tipo == "Suv":
    modelo = SUV(180, "Preto")
else: 
    modelo = Hatch(220, "Branco")

motor = Motor()
motor.escolher_tipo()

opcional = Opcional()
opcional.escolher_opcionais()

# Cálculo do valor total
total = calcular_valor_total(modelo.valor_modelo, motor, opcional)

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