Infelismente por falta de tempo não foi possivel concluir todo o CRUD do FRONT, mas só consegui implementar o listar, porem o back-end feito em Symfony 4 esta concluido.
Tive um certo problema com o gitLab, pois então fiz no github e importei para o gitlab, espero que não seja prejudicado por conta disso.

# O que foi Feito
	1. CRUD para as Empresas
	2. CRUD para sócios
  

# back-end feito em Symfony
Depois que você clonar o codigo do gitLab para a  dentro da pasta htdocs

  1-Abra o git bash dentro da pasta "vox" e utilize "composer install" -> para instalar todas as dependencias.
  2. Abra o aquiro .env e coloque as configurações do seu banco.
	  2.1. Exemplo:
		
		  DATABASE_NAME=vox
	   	DATABASE_HOST=localhost
		  DATABASE_PORT=5432
	  	DATABASE_USER=postgres
	  	DATABASE_PASSWORD=123
		
		Obs: O banco deve ser *postgreesql*
	 2.2. o drive pdo_pgsql e pgsql devem estar habilitados nas configuracoes do php.ini

  
  2-Logo mais digite "php bin/console doctrine:database:create" ->Para criar o banco de dados
  
  3-Em seguida "php bin/console doctrine:migrations:migrate" -> Para migrar os dados da entity para o banco, assim criando as tabelas
  
  4-Utilize o  comando "symfony serve"
  
  5-Abra o postman e faça os seguintes teste das rotas 
    5.1- Teste de rotas de empresa
       requisição tipo GET -> http://127.0.0.1:8000/empresa
       
       requisição tipo GET -> http://127.0.0.1:8000/empresa/{id}
       
       "Essa requisição  a baixo lista a empresa com os dados do socio passado por parametro";
       requisição tipo GET -> http://127.0.0.1:8000/empresa/socios/{id} 
       
       requisição tipo POST -> http://127.0.0.1:8000/empresa/inserir
       
       requisição tipo DELETE -> http://127.0.0.1:8000/empresa/delete/{id}
       
       requisição tipo UPDATE -> http://127.0.0.1:8000/empresa/atualizar/{id}
       
    5.2- Teste de rotas de Socios 
    
       requisição tipo GET -> http://127.0.0.1:8000/socio/
       
       requisição tipo GET -> http://127.0.0.1:8000/socio/{id}
       
       requisição tipo POST -> http://127.0.0.1:8000/socio/inserir
       
       requisição tipo DELETE -> http://127.0.0.1:8000/socio/delete/{id}
       
       requisição tipo UPDATE -> http://127.0.0.1:8000/socio/atualizar/{id}
       
       
 # Front-End feito em Angular
   Depois que você clonar o codigo do gitLab 
    
    1-Abra o git bash dentro da pasta "front-vox" e utilize "Npm install" -> para instalar todas as dependencias.
    2-Dentro do git bash utilize o ng serve
    
  
       

