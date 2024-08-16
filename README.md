# Projeto Laravel com Docker Compose

Este projeto utiliza Laravel, Laravel Breeze, Inertia.js e Docker Compose para configurar um ambiente de desenvolvimento completo.

## Requisitos

- Docker
- Docker Compose

## Configuração

1. **Clone o repositório**:

    ```bash
    git clone <url-do-repositorio>
    cd <nome-do-repositorio>
    ```

2. **Crie um arquivo `.env`** na raiz do projeto com as seguintes variáveis de ambiente:

    ```dotenv
    WWWGROUP=1000
    WWWUSER=1000
    APP_PORT=8088
    VITE_PORT=5173
    SAIL_XDEBUG_MODE=off
    SAIL_XDEBUG_CONFIG=client_host=host.docker.internal
    DB_PASSWORD=secret
    DB_DATABASE=laravel
    DB_USERNAME=root
    FORWARD_DB_PORT=3309
    FORWARD_REDIS_PORT=6379
    FORWARD_MEILISEARCH_PORT=7700
    FORWARD_MAILPIT_PORT=1026
    FORWARD_MAILPIT_DASHBOARD_PORT=8029
    MEILISEARCH_NO_ANALYTICS=false
    ```

3. **Suba os containers**:

    ```bash
    docker-compose up -d
    ```

4. **Acesse a aplicação**:

    - Aplicação Laravel: [http://localhost:8088](http://localhost:8088)
    - Dashboard do Mailpit: [http://localhost:8029](http://localhost:8029)

## Uso

Após a configuração inicial, você pode acessar a aplicação Laravel e desenvolver normalmente. O Breeze fornece uma configuração básica de autenticação e o Inertia.js integra o Vue.js para uma experiência de SPA.

## Scripts Úteis

- **Parar os containers**:

    ```bash
    docker-compose down
    ```

- **Verificar os logs**:

    ```bash
    docker-compose logs
    ```

- **Recriar o banco de dados**:

    ```bash
    docker-compose exec mysql mysql -u root -p${DB_PASSWORD} -e "DROP DATABASE IF EXISTS ${DB_DATABASE}; CREATE DATABASE ${DB_DATABASE};"
    ```

## Licença

Este projeto está licenciado sob a MIT License. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

