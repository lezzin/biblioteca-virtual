# Biblioteca virtual

<div style="display: inline_block"><br>
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white"  alt="PHP Logo" align="center" />
    <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white"  alt="Bootstrap Logo" align="center" />
    <img src="https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white"  alt="jQuery Logo" align="center" />
    <img src="https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white"  alt="MySQL Logo" align="center" />
</div><br>

![Readme Card](https://github-readme-stats.vercel.app/api/pin/?username=lezzin&repo=biblioteca-virtual&theme=dark&show_owner=true)


## Nesse projeto, você precisará do MySQL e XAMPP para poder utilizar a página... os downloads se encontram aqui: [MySQL](https://dev.mysql.com/downloads/workbench/) e [XAMPP](https://www.apachefriends.org/pt_br/download.html)<br><br>

## Tutoriais

1- Baixe o arquivo zip do projeto e extraia ele em sua área de trabalho, agora, você irá mover a pasta extraída para o seguinte local: C:\xampp\htdocs\mova-a-pasta-aqui<br>

2- Agora, quando baixados e instalados, primeiro abra o XAMPP e clique em Start para o SQL e Apache.

 - Após isso, abra o MySQL Workbench e crie uma conexão, certifique-se de que o nome dela seja Localhost, usuário seja root e que não tenha nenhuma senha.<br>
 - Clique duas vezes sobre a conexão e será aberta uma página com um query em branco. 
 - Após isso, abra a pasta onde se encontra o projeto da biblioteca virtual, clique na pasta db e novamente clique duas vezes sobre o arquivo "script db biblioteca". 
 -  Creio que será aberto o query com os scripts do banco de dados, então, basta ir na parte superior da tela e clicar no raio, ao lado do card de salvamento.
 - O banco de dados será criado.

3- Vá para seu navegador e digite na barra de pesquisa "localhost".
 - Caso não apareça uma página com as pastas no htdocs, basta digitar "localhost/nome-da-pasta-que-está-a-biblioteca", que no caso, é biblioteca virtual.
 - Agora, é só clicar em login.php e será aberta a página de login.

4- Clique em "Criar nova conta" e insira os dados que se pede. Inseridos, volte para a página de login e coloque o nome de usuário e senha inseridos no cadastro.
 - Você será dimensionado para a página inicial e assim, poderá navegar pelas funções da biblioteca.<br><br>

### AVISOS

 - Na página de catálogo, caso você tente deletar ou editar os dados e aparece a mensagem de que não tem permissão, basta seguir os passos:
 - Vá para a pasta "pages" e clique em delete.php
 - Procure a linha <code>if ($_SESSION['UsuarioID'] != 1)</code> e altere o valor "1" para o ID em que você foi cadastrado (você pode ver isso no banco de dados, basta digitar no query o comando <code>"SELECT * FROM cliente"</code> e aparecerá seu ID).
 - Vá para a pasta "pages" novamente e repita o passo acima com o arquivo edit.php.
 - Agora é só salvar os arquivos e atualizar a página em seu navegador.
 - Caso você não possuia um editor de códigos como Sublime ou VSCode, as alterações também podem ser feitas no bloco de notas.
  <br>
  *Vale ressaltar que esse projeto foi feito a fins de estudos, assim, poderá apresentar erros.*<br>
  Caso queira me dar alguma crítica construtiva, dizer algum erro ou tirar dúvidas, me contate em minhas redes sociais:<br>

[![Instagram](https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white)](https://www.instagram.com/leandroadrian_/)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/leandro-adrian)
[![Telegram](https://img.shields.io/badge/Telegram-2CA5E0?style=for-the-badge&logo=telegram&logoColor=white)](https://t.me/LeandroAdrian)

Até o próximo projeto!
