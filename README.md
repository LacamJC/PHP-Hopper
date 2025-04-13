# 📝 CRUD com Autenticação e PHP Puro

## 🎯 Objetivos do Projeto

Este projeto foi desenvolvido como um sistema de autenticação completo com as seguintes finalidades:

- Demonstrar a implementação de um CRUD seguro em PHP puro
- Gerenciamento de usuários com autenticação
- Praticar conceitos de segurança como hash de senhas
- Implementar padrões de projeto como Gateway
- Servir como base para aprendizado de RabbitMQ (implementação futura)

## ✨ Principais Funcionalidades

| Funcionalidade         | Descrição                                | Método/Tecnologia Utilizada                       |
|------------------------|-------------------------------------------|--------------------------------------------------|
| Cadastro de usuários   | Validação de dados e armazenamento seguro | PHP + SQLite + `password_hash()`                |
| Autenticação           | Login com sessões                         | PHP Sessions + `password_verify()`              |
| Atualização de perfil  | Edição de dados do usuário                | PDO + `UserGateway`                             |
| Mensagens do sistema   | Feedback visual para ações do usuário     | Bootstrap Alerts + Session Flash                |
| Interface responsiva   | Adaptável a diferentes dispositivos       | Bootstrap 5                                     |

## 🛠️ Tecnologias Utilizadas

### Backend:
- PHP 7.4+
- PDO (PHP Data Objects)
- SQLite (Banco de dados embutido)
- Password Hashing API (PHP)

### Frontend:
- Bootstrap 5 (CSS/JS)
- Bootstrap Icons
- JavaScript Vanilla

## 📂 Estrutura do Projeto

```
src/
├── assets/
│   └── js/
│       └── showPassword.js       # Controle de exibição de senha
├── classes/
│   ├── events/
│   │   └── Alert.php             # Sistema de mensagens
│   ├── rdg/
│   │   └── UserGateway.php       # Operações com usuários
│   └── validation/
│       └── ValidateUser.php      # Validador de usuários
├── database/
│   ├── database.db               # Arquivo do SQLite
│   └── tables.sql                # Schema inicial
├── services/
│   ├── processar_cadastro.php
│   ├── processar_login.php
│   ├── processar_logout.php
│   └── processar_update.php
├── views/
│   ├── login.php
│   └── perfil.php
└── index.php                     # Página inicial
```

## 🔒 Princípios de Segurança Implementados

### Hash de Senhas:
- Uso de `password_hash()` e `password_verify()`
- Nenhuma senha é armazenada em texto puro

### Proteção Básica:
- Validação de formulários no backend
- Redirecionamentos seguros após ações
- Destruição de sessão no logout

### Boas Práticas:
- Separação de responsabilidades
- Tratamento de erros básico
- Uso de PDO para acesso a dados

## ⚠️ Melhorias Pendentes (Roadmap)

### Segurança Avançada:
- Implementar *prepared statements*
- Adicionar tokens CSRF
- Limitar tentativas de login

### Arquitetura:
- Implementar padrão *Repository*
- Adicionar sistema de rotas
- Implementar injeção de dependência

### Novas Funcionalidades:
- Sistema de recuperação de senha
- Confirmação por e-mail
- Integração com RabbitMQ para tarefas assíncronas

## 🚀 Como Executar o Projeto

### Pré-requisitos:
- PHP 7.4+ instalado
- Servidor web (Apache/Nginx) ou PHP built-in server

### Passos:
1. Clone o repositório
2. Navegue até a pasta `src/`
3. Execute o comando:

```bash
php -S localhost:8000
```

4. Acesse no navegador:

```
http://localhost:8000
```

### Credenciais de Teste:
- **Email:** joao@gmail.com
- **Senha:** 123456

## 📝 Notas de Desenvolvimento

Este projeto foi desenvolvido como:

- Exercício de aprimoramento em PHP puro
- Base para estudos de mensageria com RabbitMQ
- Demonstração de padrões de projeto aplicados

**Autor:** João Ramajo  
**Data:** 12/04/2025  
**Versão:** 1.0.0
