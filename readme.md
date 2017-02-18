# Laravel server monitor

## Etapas:
### Laravel Base
- criar banco de dados
- ~~tabela dos cadastros~~
- ~~criar tabela dos servidores~~ (2017_02_16_235547_create_server_info.php)
- ~~criar tabela dos logs~~ (2017_02_17_000332_create_server_log.php)
- ~~criar tabela das empresas cadastradas~~ (2017_02_18_093009_create_company)
- ligar tabela de usuários e de servidores a de empresas cadastradas
- criar tabela que irá hospedar nossos logs no cliente
### Atualizar logs
- Cron para acessar servidor do cliente
- Pegar os dados da tabela de logs do cliente
- Processar o que for necessário para o relatório
- Salvar log do cliente no redis
- Salvar log do cliente no banco
- Atualizar registro do servidor para definir que foi atualizado
### Criação das telas
- Login do usuário
- Menu do usuário com as maquinas dele
- Exibição de 1 relatório
- Relatório multiplos relatórios em tela
- Relatório dinâmico com ajax
### Segurança
- Ao logar, salvar em redis os servidores que o usuário tem acesso
- Ao consultar a tela de relatório, verificar se o usuário tem acesso via redis
- Ao consultar o ajax, verificar se o usuário tem acesso via redis


-----

## Notificações
### Banco de dados
- criar tabela de configuração de notificação geral/por server
- criar tabela dos tokens de aparelhos (mobile/navegador) do usuário
### Telas
- Criar tela de configuração de notificação geral
- Criar tela de configuração de notificação por server
### Client-side
- Pedido de alerta no navegador
### App
- Receber alertas
- Abrir os relatórios


-----

## Dashboard Ninâmico
- criar banco de dados
- criar tabela das dashboards do usuário
- criar tabela dos relatórios da dashboard
- criar tabela das configurações
- Criar Telas
- Criar dashboard dinâmica
- Criar tela de personalização da dashboard


-----
## Futuras:
- Atualizar registro do servidor para definir que está atualizando (para mais servidores)
- Criar extenção no chrome para ver os relaórios

