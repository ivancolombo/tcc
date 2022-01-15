

# TCC

Protótipo desenvolvido para o TCC no curso de Sistemas de Informação. Com o objetivo da realização de consultas médicas online.


## Tecnologias utilizadas

- **PHP**
- **Laravel**
- **PostgreSQL**
- **AdminLTE**
- **Bootstrap**
- **Jitsi**


## Descrição das telas do protótipo

O protótipo possui uma tela de login para acesso com 4 tipos de usuários diferentes, Administrador, Assistente, Médico e Paciente. O cadastro de Administrador e Assistente são efetuados na guia Administradores, devendo o primeiro usuário administrador estar previamente cadastrado.  

O cadastro de “Administradores” e “Assistentes" são realizados na tela conforme figura. No campo “Tipo” deverá ser informado se o usuário será Administrador ou Assistente, os demais campos são os dados de registro, sendo que o e-mail será utilizado para login. 

![image](https://user-images.githubusercontent.com/68520525/149639959-aacb54df-621b-45d9-8ff2-fab0025990cd.png)

O cadastro de Médicos e Pacientes são efetuados através dos menus “Médicos” e “Pacientes” respectivamente. Ao cadastrar um novo médico é apresentado o formulário. 

Nesse cadastro é possível selecionar uma imagem para o perfil, no campo “Especialidade” deve ser selecionado qual a especialidade do médico, que deve estar previamente cadastrada no menu “Especialidades”. No campo CRM deve ser informado o número de registro do médico e nos campos Registro de Qualificação de Especialista (RQE) podem ser informados até dois valores pois é o máximo permitido para um profissional. Com exceção dos RQEs, o restante dos campos são todos obrigatórios. 

![image](https://user-images.githubusercontent.com/68520525/149639980-f0a1ce22-5ee8-47bb-afc2-de097197f8dc.png)
![image](https://user-images.githubusercontent.com/68520525/149639999-d9ecb53e-b948-48f4-b0d5-340de2755f9d.png)

O cadastro do paciente, também terá a possibilidade de carregar uma foto de perfil, ao clicar no calendário no campo “Data de Nascimento” é possível selecionar a data ou também digitar diretamente no campo. No campo “CEP” ao informar o CEP é preenchido os demais campos automaticamente. Todos os campos são obrigatórios. 

![image](https://user-images.githubusercontent.com/68520525/149640024-ccd307c5-af06-4f36-acf8-f9438cdc8eff.png)
![image](https://user-images.githubusercontent.com/68520525/149640030-f78ba558-ae89-49cd-87c8-66cad44d651e.png)

Ao acessar o sistema com um usuário do tipo Assistente, será possível visualizar além do menu “Paciente” e o menu “Gerenciar Agenda”, que será responsável por informar os horários em que o médico irá atender. Outras funções do Assistente são desmarcar ou cancelar horários de consultas e manter o cadastro de Pacientes.  

![image](https://user-images.githubusercontent.com/68520525/149640108-6b85b75e-bcda-4d8a-b227-3b7e66b1b413.png)

Para o gerenciamento da agenda, após selecionar um médico no campo “Médico” 
será apresentado o botão “Cadastrar Horários”, 
ao clicar é demonstrada a interface. 
Nesta tela estão as opções para definir uma carga horária para o médico, 
onde deve ser marcado quais os dias da semana ele irá atender, bem como o horário de início no campo “Início” e no campo “Fim” o horário em que irá encerrar o dia.  

No campo “Intervalo Horário” deve ser informado em minutos a duração de cada consulta e os campos “De” e “Até” definem o período de vigência do horário cadastrado, que pode atingir no máximo 3 meses de duração. 

![image](https://user-images.githubusercontent.com/68520525/149640094-8c04f028-133c-4d8e-a13d-5533eb3ddf29.png)

A exclusão desses horários é feita de forma parecida com a de cadastro, porém com a diferença de que o campo “Intervalo” não existe. O menu de exclusão deve ser acessado pela janela principal da agenda. 

O acesso do tipo paciente mostra duas opções de menu, em “Médicos” são listados os médicos disponíveis para agendamento com opção de filtro por “Especialidade” e “Nome”.  

![image](https://user-images.githubusercontent.com/68520525/149640414-07b7c673-232c-48ca-98bd-0a49ad95d35b.png)

Ao clicar no botão “Agendar” é apresentado a tela, onde deve ser definido um dia e ao clicar em “Buscar” são disponibilizados os horários deste dia. Ao clicar no ícone de relógio ao lado do horário desejado será aberto uma tela do tipo modal para informar uma breve descrição, não obrigatória e com o botão “Confirmar” será efetivado o agendamento da consulta. 

![image](https://user-images.githubusercontent.com/68520525/149640442-66f52062-5396-4ee9-8a99-609caf19b5a4.png)

No menu “Minhas Consultas” ficam as informações dos agendamentos realizados, sendo possível visualizar os dados do médico e o horário agendado. Com 10 Minutos de antecedência do horário é mostrado o botão “Iniciar” que permite o acesso a tela de videoconferência. Esses dados são apresentados em um formato parecido com a consulta de médicos. 

![image](https://user-images.githubusercontent.com/68520525/149640827-4f18add5-613b-4b6e-988a-e9165eab2665.png)

Quando o acesso é feito com um usuário do tipo Médico é mostrado o menu “Minha Agenda”, responsável por listar os agendamentos deste médico, sendo que as consultas anteriores e futuras não podem ser iniciadas, ficando apenas a nível informativo.  

Nessa listagem são demonstradas as informações do paciente e o horário agendado. Também com 10 Minutos de antecedência, será apresentado um botão “Iniciar”.  

![image](https://user-images.githubusercontent.com/68520525/149640843-ae970e58-720c-4654-9e50-e41db3638695.png)

Clicando em “Iniciar”, onde são exibidos mais detalhes do paciente, com a opção de realizar anotações no campo “observação”. Em “Histórico de Consultas” são exibidos os atendimentos anteriores deste paciente, onde o médico pode visualizar as observações que foram anotadas em cada consulta. O botão “Iniciar Chamada” dá acesso a sala de videoconferência e o botão “Finalizar Consulta” finaliza o atendimento. 

![image](https://user-images.githubusercontent.com/68520525/149640874-3cfa2d96-4b39-4679-a75c-37a50f08a603.png)

Para ambos usuários “Médico” e “Paciente” ao iniciar a consulta é apresentada uma tela conforme a abaixo, onde ao clicar no botão “Participar da Reunião” os usuários iniciam a chamada com a possibilidade de realizar a consulta por microfone, mensagem de texto ou vídeo. 

![image](https://user-images.githubusercontent.com/68520525/149640888-160a890f-50e2-497f-ae57-4d5b13347bd8.png)

