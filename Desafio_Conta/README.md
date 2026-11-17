# Sistema Bancário em Python - Desafio DIO

Projeto desenvolvido como parte da formação **Python Fundamentals** da [Digital Innovation One (DIO)](https://dio.me).

Este projeto simula as operações essenciais de um sistema bancário moderno via terminal (linha de comando), aplicando conceitos fundamentais e avançados da linguagem Python.

---

## 🌟 Sobre o Projeto

O objetivo deste projeto é construir uma aplicação bancária robusta e organizada, indo além dos scripts básicos. Ele implementa regras do mundo real (como limites diários de saques, histórico detalhado de movimentações e persistência de dados), estruturado com as melhores práticas de desenvolvimento.

O projeto foi pensado de forma clara e acessível: qualquer pessoa, mesmo sem conhecimento prévio em programação, consegue entender como o sistema funciona e operá-lo pelo terminal.

---

## 🚀 Funcionalidades

- **Gerenciamento de Clientes:** Cadastro completo com nome, CPF, data de nascimento e endereço residencial.
- **Abertura de Contas:** Criação e vinculação de contas correntes a clientes cadastrados.
- **Depósitos e Saques:** Operações seguras com validação de saldo, limite por saque (R$ 500,00) e limite de até 3 saques diários.
- **Extrato Detalhado:** Visualização de todas as transações realizadas com data, hora, tipo de operação e saldo atualizado.
- **Histórico & Auditoria Enriquecida (Log):** Registro automático em arquivo (`log.txt`) de cada ação executada no sistema com data, horário, titular, conta e valores movimentados.
- **Armazenamento Persistente de Dados:** Clientes e contas bancárias com seus respectivos saldos são salvos em arquivos (`clientes.csv` e `contas.csv`), garantindo que nenhuma informação seja perdida ao fechar e reabrir o programa.

---

## 🧠 Conceitos e Tecnologias Aplicadas

O projeto foi desenvolvido em **Python 3** e utiliza recursos que demonstram a evolução do aprendizado:

1. **Programação Orientada a Objetos (POO):**
   - **Classes e Herança:** Separação clara entre `Cliente`, `PessoaFisica`, `Conta` e `ContaCorrente`.
   - **Classes Abstratas:** Uso de `ABC` (`abc.abstractmethod`) para padronizar as transações (`Transacao`, `Saque`, `Deposito`).
   - **Encapsulamento e Separação de Responsabilidades:** Proteção de atributos internos (como `_saldo` e `_historico`) com `@property`, deixando as regras de negócio desacopladas da interface de exibição.

2. **Iteradores e Geradores:**
   - **Iterador personalizado (`ContasIterador`):** Permite percorrer as contas cadastradas de forma elegante.
   - **Gerador (`yield`):** O histórico de transações utiliza gerador para criar relatórios sob demanda com economia de memória.

3. **Decoradores (Decorators):**
   - `@log_transacao`: Envolve funções para registrar automaticamente o momento de execução, status e detalhes operacionais no arquivo `log.txt`.

4. **Manipulação de Arquivos e Datas:**
   - Módulo `pathlib` e `csv` para salvar e recuperar clientes e contas de forma padronizada.
   - Módulo `datetime` para registro temporal e controle do limite diário de operações.

---

## 📁 Estrutura de Arquivos

```text
Desafio_Conta/
├── Classes_Desafio.py       # Definição das classes base (Cliente, Conta, Histórico, Iterador)
├── Exercise_Desafio_Log.py  # Regras de negócio, decorator de log, persistência CSV e menu CLI
├── clientes.csv             # Base de dados dos clientes cadastrados
├── contas.csv               # Base de dados das contas e saldos vinculados aos clientes
├── log.txt                  # Histórico de auditoria detalhado das operações executadas
└── README.md                # Documentação do projeto
```

---

## 💻 Como Executar o Projeto

### Pré-requisitos
- Ter o **Python 3.8** ou superior instalado no computador.

### Passo a passo
1. Clone este repositório ou baixe os arquivos para uma pasta no seu computador:
   ```bash
   git clone https://github.com/Rodves/Projetos-Pessoais.git
   ```
2. Abra o terminal (Prompt de Comando, PowerShell ou Terminal do Linux/Mac) e navegue até a pasta do projeto:
   ```bash
   cd Desafio_Conta
   ```
3. Execute o arquivo principal:
   ```bash
   python Exercise_Desafio_Log.py
   ```
4. Navegue pelo menu interativo digitando a opção desejada:
   - `nu` para cadastrar um novo usuário (cliente).
   - `nc` para criar uma nova conta.
   - `d` para depositar.
   - `s` para sacar.
   - `e` para ver o extrato.
   - `lc` para listar as contas.
   - `q` para sair.

---

## 🤝 Conecte-se Comigo

Projeto desenvolvido por **Rodrigo Cesar**.

- **GitHub:** [Rodves/Projetos-Pessoais](https://github.com/Rodves/Projetos-Pessoais)
- **DIO:** [Meu Perfil na DIO](https://web.dio.me)

---
*Projeto educacional desenvolvido durante a Formação Python Fundamentals na DIO.*
