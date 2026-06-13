# Situação-Problema: Gestão Ineficiente de Atividades no Ensino EAD

## Contextualização

A escola técnica **Centro de Formação Profissional Horizonte Digital** oferece cursos na modalidade de Ensino a Distância (EAD) para centenas de alunos distribuídos em diferentes turmas. O crescimento no número de estudantes e professores trouxe desafios administrativos relacionados ao gerenciamento das atividades acadêmicas.

Atualmente, os professores enviam atividades por e-mail ou aplicativos de mensagens, enquanto a coordenação mantém planilhas separadas para controle das turmas e docentes. Esse processo tem causado diversos problemas operacionais, como:

* Dificuldade no cadastro e gerenciamento de professores;
* Falta de organização das turmas vinculadas a cada professor;
* Perda de atividades enviadas pelos docentes;
* Retrabalho para localizar conteúdos aplicados em turmas específicas;
* Exclusão incorreta de turmas que ainda possuem atividades vinculadas;
* Falta de um ambiente centralizado para gerenciamento acadêmico.

Além disso, a coordenação pedagógica precisa ter controle sobre quais professores estão cadastrados no sistema e garantir que apenas usuários autorizados possam acessar determinadas funcionalidades.

## Problema

A instituição necessita de um sistema informatizado capaz de:

1. Permitir login seguro para professores e administradores;
2. Cadastrar professores na plataforma;
3. Organizar turmas vinculadas a professores específicos;
4. Permitir que professores cadastrem atividades para suas turmas;
5. Listar e consultar turmas e atividades cadastradas;
6. Impedir a exclusão de turmas que ainda possuam atividades associadas;
7. Centralizar as informações acadêmicas em um único ambiente digital.

## Solução Proposta

Para solucionar o problema, foi desenvolvido um **Sistema Web de Gerenciamento de Atividades EAD**, utilizando **PHP**, **MySQL**, **HTML**, **Bootstrap** e gerenciamento de sessão.

O sistema possui dois níveis de acesso:

### Administrador

O administrador realiza:

* Login administrativo;
* Cadastro de professores;
* Consulta da lista de professores;
* Exclusão de professores quando permitido.

### Professor

O professor pode:

* Realizar login no sistema;
* Cadastrar turmas;
* Visualizar turmas sob sua responsabilidade;
* Cadastrar atividades para uma turma específica;
* Consultar atividades cadastradas;
* Excluir turmas somente quando não houver atividades vinculadas.

## Regras de Negócio Implementadas

* Apenas usuários autenticados podem acessar o sistema;
* Professores visualizam apenas suas próprias turmas;
* Uma turma não pode ser removida caso existam atividades associadas;
* Professores precisam estar previamente cadastrados pelo administrador;
* O sistema utiliza sessões para manter autenticação durante o uso.

## Benefícios Esperados

Com a implementação do sistema, espera-se:

* Redução da desorganização acadêmica;
* Centralização das informações das turmas;
* Melhor controle de professores e atividades;
* Aumento da produtividade administrativa;
* Redução de erros no gerenciamento das turmas;
* Maior segurança no acesso às informações.

## Tecnologias Utilizadas

* PHP (Back-end)
* MySQL (Banco de Dados)
* HTML5
* CSS / Bootstrap
* Sessões PHP para autenticação

## Resultado Esperado

Ao final da implementação, a instituição terá um sistema funcional capaz de gerenciar professores, turmas e atividades EAD de forma centralizada, segura e eficiente, reduzindo falhas administrativas e melhorando a experiência de gestão do ensino.
