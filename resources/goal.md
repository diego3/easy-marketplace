# Backend Challenge

Desafio Easy Carros para backend developers.

## IntroduÃ§Ã£o

VocÃª estÃ¡ participando do processo para integrar o time de Produto e Tecnologia da [Easy Carros](https://easycarros.com/).

Este desafio tem como objetivo avaliar seus *skills* na criaÃ§Ã£o de cÃ³digo para backend -- mais especificamente, uma Web API -- para um problema do mundo real.

## O que Ã© a Easy Carros?

A Easy Carros surgiu como uma plataforma de marketplace para serviÃ§os automotivos.

O modelo de negÃ³cios Ã© parecido com o do Mercado Livre ou do Uber: nÃ³s fornecemos a tecnologia que une o consumidor -- pessoa ou empresa que possua veÃ­culos automotivos -- com empreendedores independentes, especializados na prestaÃ§Ã£o de serviÃ§os como: lavagem a seco, troca de Ã³leo, martelinho de ouro, etc.

## O desafio

Sua missÃ£o Ã© criar uma versÃ£o simplificada do Easy Carros Marketplace, que funcione como uma Web API.

VocÃª tem uma lista com os dados dos nossos parceiros prestadores de serviÃ§o -- `partners.json` -- contendo os seguintes dados:

- `id : String`: o ID do parceiro.
- `name : String`: o nome do parceiro.
- `availableServices : String[]`: um array contendo quais serviÃ§os aquele parceiro oferece. 
    - SÃ£o apenas 2 serviÃ§os possÃ­veis: `'OIL_CHANGE'` e `'DRY_WASHING'`. 
    - Cada parceiro pode oferecer apenas um deles ou ambos.
- `location : Object`: um objeto contendo as coordenadas do endereÃ§o-base do parceiro.
- `location.lat : Number`: a latitude da localizaÃ§Ã£o. Ex.: `-23.550520`
- `location.long : Number`: a latitude da localizaÃ§Ã£o. Ex.: `-46.633308`

Existem outras propriedades dentro do objeto `location`, mas elas nÃ£o sÃ£o importantes para este exercÃ­cio.

VocÃª tem uma lista com os dados dos nossos clientes -- `users.json` -- contendo os seguintes dados:

- `id : String` o ID do cliente.
- `name : String` o nome do cliente.
- `email : String` o email do cliente.
- `password : String` a senha do cliente em plain text (calma, Ã© sÃ³ pra facilitar, nÃ³s nÃ£o fazemos isso!!! ðŸ˜…).

VocÃª precisa implementar as seguintes histÃ³rias de usuÃ¡rio:

### 1. UsuÃ¡rio se autentica na aplicaÃ§Ã£o

> Eu, como cliente da Easy Carros, gostaria de me autenticar no sistema, fornecendo:
>
>   1. E-mail
>   2. Senha
>
> Caso o e-mail e a senha estejam corretos:  
>   quero receber um token de autenticaÃ§Ã£o. 
>
> Caso contrÃ¡rio:  
>   quero receber uma mensagem de erro me informando do problema.

Dicas:

- Utilize JWT para nÃ£o ter que se preocupar em como gerar o token.

### 2. UsuÃ¡rio solicita serviÃ§o

> Eu, como cliente da Easy Carros, gostaria de  
>   uma vez que estiver logado no sistema  
>   poder solicitar um dos serviÃ§os disponÃ­veis, fornecendo:
>
>   1. O token de autenticaÃ§Ã£o
>   2. O tipo de serviÃ§o que eu preciso: `'OIL_CHANGE'` ou `'DRY_WASHING'`.
>   3. As coordenadas (lat e long) do endereÃ§o onde quero que o serviÃ§o seja realizado.
> 
> Caso o token seja invÃ¡lido:  
>   quero receber um erro me informando do problema.
>
> Caso haja algum profissional disponÃ­vel para aquele serviÃ§o **dentro de um raio de 10 km**:  
>   quero receber as informaÃ§Ãµes de 01 profissional escolhido (qualquer um que respeite os critÃ©rios). 
>
> Caso contrÃ¡rio:  
>   quero receber uma mensagem de erro me informando que nÃ£o hÃ¡ um profissional disponÃ­vel.

Dicas:

- Lembre-se de checar se o profissional fornece o tipo de serviÃ§o pedido.
- VocÃª vai precisar converter a distÃ¢ncia entre as coordenadas para quilÃ´metros.

### BÃ´nus

Implemente um segundo endpoint para a seguinte histÃ³ria de usuÃ¡rio:

### 3. UsuÃ¡rio busca profissionais disponÃ­veis

> Eu, como cliente da Easy Carros, gostaria de,
>   uma vez que estiver logado no sistema,  
>   poder visualizar uma lista de profissionais que atendem um determinado endereÃ§o, fornecendo:
>
>   1. O token de autenticaÃ§Ã£o
>   2. **O endereÃ§o** (Ex.: Av. Paulista, 1578) onde quero que o serviÃ§o seja realizado.
>
> Caso o token seja invÃ¡lido:  
>   quero receber um erro me informando do problema.
>
> Caso haja profissionais disponÃ­veis para aquele serviÃ§o **dentro de um raio de 10 km**:  
>   quero receber uma lista com todos os profissionais que atendem dentro desse raio, contendo pelo menos:
>
>   1. Nome
>   2. ServiÃ§os disponÃ­veis
>
> Caso contrÃ¡rio:
>   quero receber uma lista vazia.

Dicas:

- Use algum serviÃ§o de geo-location (Ex.: Google Maps API) para obter as coordenadas a partir de um endereÃ§o.

## As regras do jogo

- ðŸŒ A API deve ser implementada utilizando REST ou GraphQL.
- ðŸšª A API deve escutar a porta `8080`.
- ðŸˆ´ Use a linguagem com a qual vocÃª se sente mais confortÃ¡vel (aqui nÃ³s utilizamos principalmente **Node.js**, mas qualquer linguagem "mainstream" Ã© bem vinda).
- ðŸ“š Use qualquer soluÃ§Ã£o para data storage: banco de dados, arquivos de texto, memÃ³ria, etc.
- âœ”ï¸ Assuma que todos os dados enviados para a API sÃ£o vÃ¡lidos (nÃ£o hÃ¡ necessidade de uma camada de validaÃ§Ã£o).
- ðŸš¢ Envie seu cÃ³digo para um repositÃ³rio pÃºblico para leitura (Github, Bitbucket, Gitlab, etc.).
- ðŸ—’ï¸ Crie um arquivo `README` na raiz do projeto com instruÃ§Ãµes detalhadas de como executar seu cÃ³digo.

### BÃ´nus

- ðŸ“‘ Unit tests pelo menos para as regras de negÃ³cio.
- ðŸ“¦ Use Docker para empacotar todas as dependÃªncias em um Ãºnico lugar.

### Como vou ser avaliado?

Vamos analisar seu cÃ³digo com respeito a:

- Qualidadade de cÃ³digo
    - Keep it simple! (KISS)
- Boas prÃ¡ticas
    - Separation of Concerns (SoC)
    - Design patterns (se houver necessidade)
    - Clean code
- Code styling
    - Use um code linter ðŸ™

O que **NÃƒO** vamos analisar:

- Performance
- Escolha da tecnologia A em vez da B

## Para onde enviar seu repositÃ³rio

Envie um email para `tech@easycarros.com` com o assunto `Desafio Backend - [SEU NOME]` contendo o link para o repositÃ³rio que vocÃª criou.