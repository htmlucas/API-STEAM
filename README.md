# 🎮 Steam API

API desenvolvida em **Laravel 11** para integração com a **Steam Web API**, fornecendo endpoints para obter informações de jogadores, jogos e demais recursos disponíveis na plataforma Steam.

---

## 🚀 Funcionalidades

- 🔑 **Autenticação via Token** (JWT)  
- 👤 **Perfil de Jogador**: busca dados básicos de um usuário pelo `steamId`  
- 🎲 **Jogos Possuídos**: lista todos os jogos adquiridos pelo jogador  
- 📊 **Arquitetura em camadas (Domain Driven Design simplificado)**  
  - `DTOs` → Estruturas de dados tipadas  
  - `Services` → Lógica de negócio e integração com a Steam  
  - `Exceptions` → Tratamento de erros personalizados  
  - `Resources` → Transformação de saída para o cliente  

---

## 🛠️ Tecnologias Utilizadas

- [Laravel 11](https://laravel.com)  
- [PHP 8.2+](https://www.php.net/)  
- [Steam Web API](https://developer.valvesoftware.com/wiki/Steam_Web_API)  
- [Laravel HTTP Client](https://laravel.com/docs/http-client)  
- JWT ou Sanctum (dependendo da configuração de autenticação escolhida)  

---

## 📂 Estrutura de Pastas (simplificada)

```plaintext
app/
 └── Domain/
      └── Steam/
           ├── DTO/
           ├── Exceptions/
           ├── Services/
           └── Resources/
```

---

## ⚙️ Instalação e Configuração

### 1. Clonar repositório
```bash
git clone https://github.com/htmlucas/API-STEAM
cd steam-api
```

### 2. Instalar dependências
```bash
composer install
```
### 3. Configurar variáveis de ambiente
#### Crie um arquivo .env baseado no .env.example e configure:
```env 
APP_NAME=SteamAPI
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

STEAM_KEY=your_steam_api_key
CLIENT_KEY=your_custom_client_key
```

### 4. Gerar chave da aplicação
```bash
php artisan key:generate
```

### 5. Subir servidor local
```bash
php artisan serve
```

### 📡 Rotas Principais
#### 🔑 Login

- POST /api/login

-- Retorna um token de autenticação para ser usado nas demais rotas.

#### 👤 Perfil do Jogador

- GET /api/steam/{steamId}/profile

-- Retorna informações de um jogador.

#### 🎲 Jogos do Jogador

- GET /api/steam/{steamId}/games

-- Retorna todos os jogos possuídos pelo jogador.

### 🧪 Exemplo de Requisição no Insomnia / Postman

#### Login
```json
    POST /api/login
    {
    "email": "user@example.com",
    "password": "password"
    }
```
#### Resposta
```json
    {
    "token": "eyJhbGciOiJIUzI1..."
    }
```

#### Configure esse token no header:

```makefile
Authorization: Bearer <token>
```

#### para as próximas requisições.
