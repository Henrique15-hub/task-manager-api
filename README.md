# Meu Projeto de Tarefas - API

Esta é uma API para gerenciamento de tarefas. Com ela, você pode criar, editar, excluir e visualizar tarefas. A API foi construída utilizando o framework **Laravel** e segue os princípios de uma arquitetura RESTful.

## Tecnologias Usadas

- **PHP** - Linguagem principal para o backend.
- **Laravel** - Framework PHP utilizado para o desenvolvimento da API.
- **SQLite** - Banco de dados utilizado para armazenar as informações do projeto.
- **PHPUnit** - framework de testes utilizado para testar o projeto.

## Endpoints da API

### 1. **Criar Tarefa**
- **Método**: `POST`
- **URL**: `/api/task/store`
- **Descrição**: Valida os dados com um Form Request personalizado e em seguida cria a tarefa com uma FK vinculada ao usuario logado.
- **Parâmetros**:
  - `name` (string) - Nome da tarefa.
  - `hours` (time) - horas da tarefa.

### 2. **Listar Tarefas**
- **Método**: `GET`
- **URL**: `/api/task/index`
- **Descrição**: Retorna todas as tarefas cadastradas do usuario logado.

### 3. **Editar Tarefa**
- **Método**: `PUT`
- **URL**: `/api/task/update{id}`
- **Descrição**: Edita uma tarefa existente do usuario logado.
- **Parâmetros**:
  - `name` (string) - Novo nome da tarefa (nullable).
  - `hours` (time) - Novo horário da tarefa (nullable).

### 4. **Deletar Tarefa**
- **Método**: `DELETE`
- **URL**: `/api/tasks/destroy{id}`
- **Descrição**: Deleta uma tarefa do usuario logado.

## Como Começar

Siga os passos abaixo para rodar o projeto localmente.

### 1. Clone o Repositório

Clone o repositório para o seu ambiente local:

`git clone https://github.com/usuario/projeto-de-tarefas-api.git`

2. Instalar as Dependências
Após clonar o repositório, acesse o diretório do projeto e instale as dependências do Laravel:

`cd projeto-de-tarefas-api`
`composer install`

3. Configurar o Ambiente
Crie um arquivo .env copiando o arquivo .env.example:

`cp .env.example .env`

Em seguida, configure as variáveis de ambiente no arquivo .env (como banco de dados, e-mail, etc).

4. Gerar a Chave de Aplicação
Execute o comando abaixo para gerar a chave de aplicação do Laravel:

`php artisan key:generate`

5. Rodar as Migrations
Se você estiver utilizando MySQL ou outro banco de dados, rode as migrations para criar as tabelas necessárias:

`php artisan migrate`

6. Iniciar o Servidor Local
Inicie o servidor local para acessar a API:

`php artisan serve`

Agora, você pode acessar a API através de http://localhost:8000/api no seu navegador ou ferramentas de testes de API como Postman ou Insomnia.

## Testes Automatizados

O projeto possui testes automatizados criados com o PHPUnit (integrado ao Laravel) para garantir a integridade das funcionalidades principais da API.

### Como rodar os testes

1. Verifique se o ambiente de testes está configurado no seu arquivo .env
    `DB_CONNECTION=sqlite`

2. Execute os testes com o comando: 
 `php artisan test`

### Testes implementados
 Criação de tarefas por usuários autenticados

 Bloqueio de criação de tarefas por usuários não autenticados

 Visualização de tarefas (apenas do próprio usuário)

 Impedimento de acesso a tarefas de outros usuários

 Exclusão de tarefas

 Criação de usuários

 Validações de campos obrigatórios e dados inválidos
