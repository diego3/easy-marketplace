### Easy marketplace API

Bem-vindo à era da mobilidade
Atualize sua gestão. A Easy leva redução de custo, gestão de serviços e inteligência artificial para sua frota migrar para a era do software.

### Requisitos
 - docker engine https://docs.docker.com/install/
 - docker compose https://docs.docker.com/v17.09/compose/install

### Instalação
 O primeiro passo será instalar os containers do docker, execute o seguinte comando:
 * os comandos devem ser executados dentro da pasta raiz do projeto
 
 ```
 > docker-compose build
```
 agora você precisa subir os seus containers, execute o seguinte comando:
 ```
 > docker-compose start  (ou docker-composer up se quiser o processo em foreground)
 ```
 Tudo pronto para instalar a aplicação, execute:
```
> sh install
```
pronto, se deu tudo certo o banco de dados foi criado e populado com os dados de partners e users 

a aplicação já estará disponível em http://localhost:8080 
 
 
 ## Documentação da API
 
 a documentação da API encontra-se disponível em http://localhost:8080/developers
 nela você encontra todos os detalhes de cada endpoint.
 
 ## Exemplos de utilização com curl
 
 O primeiro passo é obter um token para acessar os recursos da API
 ```
 curl --request POST \
  --url 'http://localhost:8080/auth/login?password=lFejYz_yf0eHWnB&email=Alessandro.Moreira%40hotmail.com'
 ```
 
 -  buscando um profissional mais próximo de mim
 
 *obs troque o token por um válido
 ```
 curl --request GET \
  --url 'http://localhost:8080/api/services?lat=-27.622728&long=-48.448865&services%5B%5D=DRY_WASHING' \
  --header 'token: {cole-seu-token-aqui}'
  ```
  No exemplo acima foi utilizado a geolocalização de um bar próximo a um parceiro à Praia da Joaquina em SC. 

- procurando profissionais disponíveis para o serviço 'OIL_CHANGE' num raio de 10km.

```
curl --request GET \
  --url 'http://localhost:8080/api/partner/availables?address=Rua%20Harmonia%2C%20278%20-%20Vila%20Madalena%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2005435-000&services%5B%5D=OIL_CHANGE&area=10' \
  --header 'token: {cole-seu-token-aqui}'

```
