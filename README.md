# Projeto API de Consulta de CEPs

Este projeto é uma API desenvolvida em Laravel que permite consultar informações de múltiplos CEPs usando a API do ViaCEP. A API retorna os dados dos endereços formatados conforme a especificação fornecida.
Exemplo: Acessando o caminho /search/local/CEP-1,CEP-2

![image](https://github.com/user-attachments/assets/41c4e31f-9731-4c32-b25d-981a49ae21ee)


*Via postman*


![image](https://github.com/user-attachments/assets/2d2e27d8-9076-4579-ab9f-2dffc9277cab)


*Extra*: interface completando dados ao inserir cep


![image](https://github.com/user-attachments/assets/b7386e4b-6fe9-4f7b-9250-c64d58a002db)

## Requisitos

- PHP 8.0 ou superior
- Composer
- Laravel

## Configuração do Projeto

### Instalação

1. **Clone o Repositório**

   ```bash
   * git clone https://github.com/PedroDelgadoHenriques1/laravelcepapi.git
   * cd local-projeto-instalado
   * composer install
   * npm install

## Copie o arquivo .env.example para .env
cp .env.example .env

## Edite o arquivo .env com suas configurações(se necessário)
nano .env  # ou use qualquer editor de texto

## Gere a chave de aplicação
php artisan key:generate

## Execute as migrações do banco de dados
php artisan migrate

## Inicie o servidor
php artisan serve

