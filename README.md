![iClinic logo](https://d1ydp7gtfj5fb9.cloudfront.net/static/img/views/home_v2/header/logo.png?1525283729)

# Desafio

A missão da iClinic é descomplicar a saúde no Brasil levando mais gestão a clínicas e consultórios através da tecnologia e, com isso, possibilitar que médicos e outros profissionais promovam mais saúde aos seus pacientes.

Seu desafio será desenvolver um aplicativo para o serviço de prescrição médica e, como parte dele, veremos como você estrutura as camadas de aplicação, chamadas externas, variáveis de ambiente, cache, testes unitários, logs e documentação.

### Solução

Implementar um aplicativo em React Native para cadastrar prescrições médicas, mediante a um login na aplicação.

O mockup das telas do aplicativo foi disponibilizado no [FIGMA](https://www.figma.com/file/NoyRAtYBv5LFLhN8Q6rLql/Mobile-Challenge).

As APIs [LINK](https://iclinic-example-api-rest.herokuapp.com) que serão utilizadas durante o desafio foram disponibilizadas e podem ser consultadas pela documentação [LINK](https://iclinic-example-api-rest.herokuapp.com/documentation) e pela exportação do [POSTMAN](https://github.com/albertowlm/iclinic-example-api-rest-challenge/tree/main/postman).

* A tela de login deverá verificar a autenticação do usuário:
    * Caso positivo:
        * Redirecionar o usuário para a tela `principal`
    * Caso negativo:
        * Mostrar uma mensagem de erro, exemplo (tela `login-erro` no FIGMA)

* Exemplo de Usuário válido:
    - Email: `unclebob@gmail.com`
    - Senha: `unclebob`


### Regras da Tela Principal

* Botão `+ Médicos (Android Nativo)`
    * Médicos apenas podem ser cadastrados em dispositivos `Android`, caso o dispositivo não seja `Android`, ao clicar no botão `+ Médicos (Android Nativo)`, o usuário deverá ser informado que não é possível cadastrar médicos em dispositivos diferentes de `Android` (tela `medico-cadastrar-não-android` do FIGMA), o botão `Voltar` redireciona o usuário para a tela `principal`.
    * Sendo um dispositivo `Android`, a tela de inclusão de médico deve ser desenvolvida utilizando `Android Nativo` (Kotlin ou Java) (tela `medico-cadastrar` do FIGMA), os campos `CRM` e `NOME` são obrigatórios, o botão `Cancelar` redireciona o usuário para a tela `principal`.
    * Caso a API retorne algum erro, informar os erros (tela `medico-cadastrar-erro`)

* Botão `+ Paciente (IOS Nativo)`
    * Pacientes apenas podem ser cadastrados em dispositivos `IOS`, caso o dispositivo não seja `IOS`, ao clicar no botão `+ Paciente (IOS Nativo)`, o usuário deverá ser informado que não é possível cadastrar pacientes em dispositivos diferentes de `IOS` (tela `paciente-cadastrar-não-ios` do FIGMA), o botão `Voltar` redireciona o usuário para a tela `principal`..
    * Sendo um dispositivo `IOS`, a tela de inclusão de médico deve ser desenvolvida utilizando `IOS Nativo` (Swift ou Objective-C) (tela `paciente-cadastrar` do FIGMA), os campos `NOME`, `EMAIL` e `TELEFONE` são obrigatórios, o botão `Cancelar` redireciona o usuário para a tela `principal`.
    * `Opcional` (implementar a máscara de formatação para o telefone)
    * Caso a API retorne algum erro, informar os erros (tela `paciente-cadastrar-erro`)


* Botão `+ Prescrição (React Native)`
    * Redireciona o usuário para a tela `prescrição-listar`.

* Tela `prescrição-listar`
    * A Todas as informações da tela são retornadas pelo `GET` da API de `prescriptions`, as informações estão paginadas.
    * A funcionalidade de carregar mais, deve ser implementada utilizando o botão `+ Carregar Mais`.
    * `Opcional` implementar a paginação utilizando o deslizar para cima.
    * A busca deve ser feita utilizando o parâmetro `patient_or_physician_name` via Query String.
    * O campo com a `descrição` da prescrição no `Card`, apenas deve mostrar 40 caracteres, se tiver mais que isso, cortar e completar com "`...`".
    * Ao clicar no `Card` com os dados da prescrição, redirecionar para a tela `prescrição-detalhe`.
    * Ao clicar no botão `+ Incluir`, redirecionar para a tela `prescrição-cadastrar`.

* Tela `prescrição-cadastrar`
    * O médico deverá ser consultado a partir do nome, utilizar a API GET `physicians` para ser selecionado um `médico` previamente cadastrado, mostrar uma lista com os `médicos`, permitindo que um seja selecionado
    * O paciente deverá ser consultado a partir do nome, deverá ser consultada a API GET `patients` para ser selecionado um `paciente` previamente cadastrado, mostrar uma lista com os `pacientes`, permitindo que um seja selecionado
    * A descrição da prescrição, o médico e o paciente, são campos obrigatórios
    * O `clinic_id` da API de `prescriptions` vai ser o valor fixo `1`.
    * A API de `prescriptions` retornando sucesso, redirecionar o usuário para a tela `prescrição-listar`
    * A API de `prescriptions` retornando erro, informar o erro para o usuário (tela `prescrição-cadastrar-erro`)
    * Ao clicar no botão `Cancelar`, redirecionar o usuário para a tela `prescrição-listar`


* Tela `prescrição-detalhe`
    * As informações estão no GET da API de `prescriptions` a partir do `id` da `prescription`.
    * O botão `Alterar` redireciona o usuário para a tela `prescrição-alterar`
    * O botão `Excluir`, executa a exclusão e redireciona o usuário para a tela `prescrição-listar`
    * O botão `Cancelar` redireciona o usuário para a tela `prescrição-listar`

* Tela `prescrição-alterar`
    * O nome do médico e o nome do paciente não poderão ser alterados.
    * O campo `Descrição` deverá ser editável para alteração
    * O paciente deverá ser consultado a partir do nome, deverá ser consultada a API de GET de `patients` para ser selecionado um paciente previamente cadastrado
    * A descrição da prescrição, o médico e o paciente, são campos obrigatórios
    * O `clinic_id` da API de `prescriptions` vai ser o valor fixo `1`.
    * A API de `prescriptions` retornando sucesso, redirecionar o usuário para a tela `prescrição-listar`
    * A API de `prescriptions` retornando erro, informar o erro para o usuário (tela `prescrição-cadastrar-erro`)
    * Ao clicar no botão `Cancelar`, redirecionar o usuário para a tela `prescrição-detalhe`






### O que esperamos
- Que o desafio seja feito em `Javascript`, usar `Typescript` é um diferencial positivo;
- Implementação para Android e IOS;
- Seguir algum Style Guide de mercado;
- Passo-a-passo de como rodar sua aplicação;
- Clareza no código;
- Testes unitários com cobertura `>= 80%`;
- Princípios SOLID;
- Commits semânticos;
- Tratamento de erros e timeouts no acesso aos serviços externos;

### Não obrigatório, mas recomendado
- Testes usando Appium

### Observações
 - A parte feita com Android Nativo deverá ser feita com Kotlin ou Java;
 - A parte feita com IOS Nativo deverá ser feita com Switf ou Objective-C;

___
Boa Sorte,
Equipe iClinic.
