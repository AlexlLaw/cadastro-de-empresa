# projeto-vox-master
Depois que você clonar o codigo do gitLab para a  dentro da pasta htdocs

  1-Abra o git bash dentro da pasta "vox" e utilize "composer install" -> para instalar todas as dependencias.
  
  2-Logo mais digite "php bin/console doctrine:database:create" ->Para criar o banco de dados
  
  3-Em seguida "php bin/console doctrine:migrations:migrate" -> Para migrar os dados da entity para o banco, assim criando as tabelas
  
  4-se estiver no Windows utilize o comando "symfony serve" caso 

