# 🚀 Construindo um Sistema Bancário Moderno em Python: Do Básico à POO e Persistência de Dados

*Artigo / Publicação para a comunidade da DIO sobre o Desafio da Formação Python Fundamentals.*

---

## 📌 Introdução

Quando começamos a estudar programação, um dos primeiros grandes marcos práticos é criar um sistema que simule problemas e processos do mundo real. Na formação **Python Fundamentals** da [DIO](https://web.dio.me), fui desafiado a desenvolver um **Sistema Bancário em Python**.

O que começou como um script simples de terminal evoluiu para um projeto completo, estruturado com **Programação Orientada a Objetos (POO)**, recursos avançados da linguagem (como decoradores, geradores e iteradores) e persistência de dados em arquivos CSV.

Neste artigo, compartilho os bastidores desse desenvolvimento, os aprendizados, os obstáculos que superei e as decisões técnicas que tomei ao longo da jornada!

---

## 💡 O Desafio e as Regras de Negócio

Um banco real não se resume a somar e subtrair números na tela. Ele precisa de regras claras de segurança, integridade e controle:

1. **Limite de Saque Único:** Cada saque possui um valor teto (R$ 500,00) para proteger a conta contra retiradas excessivas.
2. **Limite Diário de Saques:** No máximo 3 saques por dia por conta corrente.
3. **Limite Global de Transações Diárias:** Controle diário para evitar sobrecarga ou operações atípicas (limite de 50 transações diárias).
4. **Histórico e Extrato Detalhado:** Rastreabilidade completa, exibindo a data, o horário e o tipo exato de cada operação realizada.
5. **Auditoria Enriquecida (Logs):** Gravação de cada operação em arquivo (`log.txt`), guardando o carimbo de data/hora, status, cliente, conta e valores movimentados.
6. **Persistência Completa:** Armazenamento de clientes (`clientes.csv`) e contas bancárias com saldos (`contas.csv`), garantindo que nenhum dado seja perdido ao reiniciar a aplicação.

---

## 🛠️ Tecnologias e Conceitos Aplicados

Durante o desenvolvimento, pude exercitar os pilares mais importantes do Python moderno:

- **Programação Orientada a Objetos (POO):** Classes bem delimitadas (`Cliente`, `PessoaFisica`, `Conta`, `ContaCorrente`), aplicando herança e métodos abstratos (`Transacao`, `Saque`, `Deposito`).
- **Encapsulamento e Separação de Responsabilidades:** Uso de propriedades (`@property`) para proteger atributos internos como saldo e histórico. As regras de negócio agora processam as operações e retornam resultados limpos, enquanto a camada do menu cuida da interação amigável com o usuário.
- **Iteradores e Geradores Customizados:**
  - `ContasIterador`: para percorrer e apresentar as contas bancárias de maneira padronizada.
  - `yield` em `gerar_relatorio()`: geração de relatórios sob demanda com economia de memória.
- **Manipulação de Arquivos e Datas:** Integração de `csv`, `pathlib` e `datetime` para dar persistência e rastreabilidade temporal ao sistema.

---

## 🧠 A Jornada de Aprendizado: O Desafio dos Decoradores

Todo aprendizado prático traz seus momentos de atrito, e no meu caso não foi diferente. 

> *"Apesar das dificuldades que enfrentei, principalmente na parte dos decoradores, consegui compreender a fundo a proposta apresentada no desafio."*

No início, o conceito de **Decoradores (Decorators)** parecia bastante abstrato: funções que recebem outras funções como parâmetro, criam uma função interna (`wrapper`), preservam metadados com `@functools.wraps` e devolvem um novo comportamento sem alterar o código original. 

O "clique" aconteceu quando implementei o `@log_transacao` para a auditoria bancária. Pude enxergar o decorador como um **auditor independente**:
- Ele fica de prontidão na porta de cada operação bancária (depósito, saque, criação de conta).
- Quando a operação acontece, ele anota no caderno de auditoria (`log.txt`) a data, a hora exata, quem realizou e qual foi o resultado.
- Tudo isso acontece **sem precisar poluir a lógica interna de cada transação com código repetitivo de escrita em arquivo**.

Superar essa barreira foi um divisor de águas nos meus estudos. Me mostrou que conceitos que parecem complexos na teoria se tornam ferramentas poderosas quando aplicados em cenários reais.

---

## 🚀 Organização e Boas Práticas

Além da sintaxe, outro grande ganho foi aprender a estruturar o projeto:
- **Modularidade:** Dividir as classes base em `Classes_Desafio.py` e o fluxo operacional em `Exercise_Desafio_Log.py`.
- **Persistência Confiável:** Separar o cadastro dos clientes (`clientes.csv`) e o vínculo com suas contas correntes (`contas.csv`).
- **Comunicação Clara:** Deixar as mensagens do terminal claras e acolhedoras para que qualquer pessoa, mesmo sem perfil técnico, compreenda o que está acontecendo em cada etapa.

---

## 🔗 Repositório e Conexão

O código completo, documentação detalhada e instruções de como rodar o projeto estão disponíveis no meu GitHub:

👉 **Repositório do Projeto:** [github.com/Rodves/Projetos-Pessoais](https://github.com/Rodves/Projetos-Pessoais)

Adoraria trocar experiências com outros estudantes e desenvolvedores da comunidade DIO! Como foi para você entender decoradores ou POO em Python? Deixe sua opinião ou feedback nos comentários! 👇
