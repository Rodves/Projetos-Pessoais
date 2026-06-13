
funcionario = {
    'Mateus': 1980,
    'Joao': 2480,
    'Maria': 3780,
    'Ana': 7300,
    'Rodolfo': 1621
}

def calcular_inss(salario):
    if salario == 1621.00:
        return salario * 0.075
    elif salario <=  2902.84:
        return salario * 0.09
    elif salario <=  4354.27:
        return salario * 0.12
    elif salario <= 8475.55:
        return salario * 0.14


def imposto(base_calculo):
    if base_calculo <= 2428.80:
        return base_calculo * 0
    elif base_calculo <= 2826.65:
        return base_calculo * 0.075 - 182.16
    elif base_calculo <=  3751.05:
        return base_calculo * 0.15 - 394.16
    elif base_calculo <=  4664.68 :
        return base_calculo * 0.225 - 675.49 
    else:
        return base_calculo * 0.275 - 908.73 

for nome,salario in funcionario.items():
    inss = calcular_inss(salario)
    base_calculo = salario - inss
    aliquota_irrf = imposto(base_calculo)
    vale_transporte = salario * 0.06
    print(inss)
    print(aliquota_irrf)
    print(vale_transporte)
    salario_liquido = salario - inss - aliquota_irrf - vale_transporte
    print(f"Funcionário: {nome}, Salário Líquido: {salario_liquido:.2f}")