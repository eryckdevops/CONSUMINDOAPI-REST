# Tecnologias Utilizadas


![PHP](https://img.shields.io/badge/PHP-7.4-blue?style=flat&logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.1.11-blue?style=flat&logo=codeigniter&logoColor=white)
![cURL](https://img.shields.io/badge/CURL-Enabled-brightgreen?style=flat&logo=curl&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-Dependency%20Manager-blue?style=flat&logo=composer&logoColor=white)
![RESTful API](https://img.shields.io/badge/API-RESTful-green?style=flat&logo=rest&logoColor=white)
![GitHub Repository Size](https://img.shields.io/github/repo-size/eryckdevops/CONSUMINDOAPI-REST.git?style=flat&logo=github&logoColor=white)
![GitHub Issues](https://img.shields.io/github/issues//eryckdevops/CONSUMINDOAPI-REST.git?style=flat&logo=github&logoColor=white)
![GitHub Pull Requests](https://img.shields.io/github/issues-pr//eryckdevops/CONSUMINDOAPI-REST.git?style=flat&logo=github&logoColor=white)
![GitHub Last Commit](https://img.shields.io/github/last-commit//eryckdevops/CONSUMINDOAPI-REST.git?style=flat&logo=github&logoColor=white)

[<img src="https://www.php.net/images/logos/new-php-logo.svg" height="50px">](https://www.php.net/)
[<img src="https://www.codeigniter.com/assets/images/ci-logo-big.png" height="50px">](https://codeigniter.com/)
[<img src="https://curl.se/logo/curl-logo.svg" height="50px">](https://curl.se/)
[<img src="https://getcomposer.org/img/logo-composer-transparent.png" height="50px">](https://getcomposer.org/)
[<img src="https://www.restapitutorial.com/wp-content/uploads/2017/11/rest-api-logo.png" height="50px">](link_para_a_documentação_da_API)
[<img src="https://github.githubassets.com/images/modules/logos_page/GitHub-Mark.png" height="50px">](https://github.com/)



# API RESTful Client Model in CodeIgniter

> # 💻 Sobre o Projeto
Este modelo do CodeIgniter é utilizado para processar e enviar pedidos pendentes a uma API RESTful. A classe APIREST encapsula todo o processo, desde a obtenção de pedidos pendentes até o envio de dados formatados via HTTP POST.

> # ⚙️ Estrutura da Classe
A classe APIREST herda de CI_Model, fazendo uso da estrutura MVC que o CodeIgniter oferece.

> # 🛠 Tecnologias Utilizadas

CodeIgniter: Estrutura MVC para PHP, facilitando a organização do código e a comunicação com a API RESTful.
PHP cURL: Para realizar requisições HTTP POST para a API.
JSON: Formato padrão para o envio de dados para a API.

> # 🛠 Detalhes Técnicos
Autenticação: Utiliza um esquema de autenticação baseado em token para se comunicar com a API.
Formato de Dados: Os dados são enviados como JSON, um formato amplamente aceito por APIs RESTful.
Tratamento de Erros: O código inclui tratamento básico de erros para problemas de comunicação e respostas inesperadas da API.

> # 🚀 Como executar o projeto

Este modelo é projetado para ser utilizado dentro de uma aplicação CodeIgniter. Para implementá-lo:

Clone o repositório (se aplicável ao seu projeto específico).
Configure o ambiente CodeIgniter seguindo a documentação oficial.
Insira o modelo na pasta models da sua aplicação CodeIgniter.
Executando o Modelo
php
Copy code
$this->load->model('APIREST');
$this->APIREST->processarEnvioPedidos();
Nota: Ajuste as funções obterPedidosPendentesImportacao, prepararItemPedido, e prepararDadosCliente conforme necessário para corresponder à estrutura de dados do seu projeto.

> # 🧭 Rodando o Modelo

Preparação: Certifique-se de que todas as dependências do CodeIgniter estão satisfeitas e de que o ambiente está corretamente configurado.
 
Envio de Dados: Utilize o método processarEnvioPedidos para automatizar o envio de pedidos à API RESTful.

> # 💡 Dicas Adicionais

Revise a documentação do CodeIgniter para ajustes e configurações adicionais.
Teste o modelo com diferentes tipos de dados para garantir a robustez.

<div align="center">
<div style="position: relative; width: 100%; height: 300px; overflow: hidden;">
  <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.pinterest.fr%2Fpin%2F562738915947303471%2F&psig=AOvVaw1X1l2Bl0bk594jC3R0tZw7&ust=1710601442040000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCIiFoIzF9oQDFQAAAAAdAAAAABAs" style="position: absolute; top: 0; left: 0; width: 100%; height: auto; animation: slide 60s linear infinite;">
  <h2 style="font-size: 24px;">🤝 Desenvolvedor</h2>
  <blockquote style="font-style: italic;">Software Engineer</blockquote>
  <table style="border: none; margin: auto;">
    <tr>
      <td align="center">
        <a href="https://github.com/eryckdevops">
          <img src="https://avatars.githubusercontent.com/u/109317442?v=4" width="160px;" style="border-radius: 50%;" alt="Erick Rodrigues"/><br>
          <sub style="font-size: 18px;"><b>Erick Rodrigues</b></sub>
        </a>
      </td>
    </tr>
  </table>
</div>

<br>

<div align="center">
  <h2 style="font-size: 24px;">📝 Licença</h2>
  <p style="font-size: 16px;">Este projeto está sob licença. Consulte o arquivo <a href="LICENSE" style="text-decoration: none; color: #0366d6;">LICENSE</a> para obter mais detalhes.</p>
</div>

<div align="center" style="margin-top: 20px;">
  <p style="font-size: 16px;">Conheça quem está por trás da magia! ✨</p>
</div>

<br>

<div align="center">
  <a href="#top" style="font-size: 16px; text-decoration: none; color: #0366d6;">Volte para o topo</a>
</div>
