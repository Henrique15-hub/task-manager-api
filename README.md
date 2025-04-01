# Desafio To-do (API)
- Este desafio tem como objetivo de testar os conhecimentos com a linguagem php e com framework Laravel para uma api, sem a necessidade de qualquer tela front-end.

## Clonar projeto ma maquina e criar uma branch e subir as alterações na branch;

## O que devemos conseguir fazer quando o teste for concluído?
### Tarefa:
1. Listar todas as tarefas do usuário logado;
2. Listar uma tarefa específica;
3. Criar uma tarefa;
4. Editar uma tarefa;
5. Deletar uma tarefa;

### User:
1. Logar usuário;
2. Deslogar usuário;

### Rotas:
1. Acessar as rotas pela API;
2. Apenas usuários logados devem conseguir executar as ações do tópico `Tarefa`;

## O que será havaliado?
1. Exigencias dos topicos Tarefa, User e Rotas;
2. Padrões de retorno das rotas;
3. Relacionamento da tarefa com o usuario;


## Dicas:
1. os nomes das funções devem ser camelCase sendo que a primeira letra deve ser minúscula e os metodos deve seguir o padrão da documentação;
   Ex:
   * index (listar todas as tarefas)
   * store (criar tarefa)
   * show (listar uma tarefa expecífica)
   * update (atualizar uma tarefa expecífica)
   * destroy (apagar uma tarefa expecífica)

   consultar na documentação: [Actions Handled by Resource Controllers](https://laravel.com/docs/12.x/controllers#actions-handled-by-resource-controllers)
2. usar banco de dados sqlite;
3. analizar padronização dos nomes das classes, exemplo a classe controller;
   * Ex: TarefaController
4. a model `Tarefa` deve ter um relacionamento belogsTo com `User`;
   consultar na documentação: [Belongs To Relationships](https://laravel.com/docs/12.x/eloquent-factories#belongs-to-relationships)
5. no controller, utilizar form request para validar os dados de entrada;
   consultar na documentação: [Creating Form Requests](https://laravel.com/docs/12.x/validation#creating-form-requests)
6. assistir videos expecificos para a duvida no youtube;
