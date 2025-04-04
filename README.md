## About
Projeto livros

## Instruções de ambiente
Basta clonar o repositório e no diretório raíz usar o seguinte comando para construir e subir os containers necessários para a aplicação
```
make build
```

Após a conclusão do processo, é necessário executar as migrations para que o banco de dados seja construído
```
make migrate
```

## Testes
Para executar os testes da aplicação utilize o seguinte comando
```
make test
```