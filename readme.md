## Laravel server monitor

## Etapas:
v1 - Laravel Base
v1-1 - criar banco de dados
~~v1-1.0 - tabela dos cadastros~~
~~v1-1.1 - criar tabela dos servidores~~ (2017_02_16_235547_create_server_info.php)
v1-1.2 - criar tabela dos logs (2017_02_17_000332_create_server_log.php)
v1-1.3 - criar tabela das empresas cadastradas
v1-1.4 - ligar tabela de usuários e de servidores a de empresas cadastradas
v1-1.5 - criar tabela que irá hospedar nossos logs no cliente
v1-2 - Atualizar logs
v1-2.1 - Cron para acessar servidor do cliente
v1-2.2 - Pegar os dados da tabela de logs do cliente
v1-2.3 - Processar o que for necessário para o relatório
v1-2.4 - Salvar log do cliente no redis
v1-2.5 - Salvar log do cliente no banco
v1-2.6 - Atualizar registro do servidor para definir que foi atualizado
v1-3 - Criação das telas
v1-3.1 - Login do usuário
v1-3.2 - Menu do usuário com as maquinas dele
v1-3.3 - Exibição de 1 relatório
v1-3.4 - Relatório multiplos relatórios em tela
v1-3.5 - Relatório dinâmico com ajax
v1-4 - Segurança
v1-4.1 - Ao logar, salvar em redis os servidores que o usuário tem acesso
v1-4.2 - Ao consultar a tela de relatório, verificar se o usuário tem acesso via redis
v1-4.2 - Ao consultar o ajax, verificar se o usuário tem acesso via redis


-----

v2 - Notificações
v2-1 - Banco de dados
v2-1.1 - criar tabela de configuração de notificação geral/por server
v2-1.2 - criar tabela dos tokens de aparelhos (mobile/navegador) do usuário
v2-2 - Telas
v2-2.1 - Criar tela de configuração de notificação geral
v2-2.2 - Criar tela de configuração de notificação por server
v2-3 - Client-side
v2-3.1 - Pedido de alerta no navegador
v2-4 - App
v2-4.1 - Receber alertas
v2-4.2 - Abrir os relatórios


-----

v3
v3-1 - criar banco de dados
v3-1.1 - criar tabela das dashboards do usuário
v3-1.2 - criar tabela dos relatórios da dashboard
v3-1.3 - criar tabela das configurações
v3-2 - Criar Telas
v3-2.1 - Criar dashboard dinâmica
v3-2.2 - Criar tela de personalização da dashboard


-----
## Futuras:
- Atualizar registro do servidor para definir que está atualizando (para mais servidores)
- Criar extenção no chrome para ver os relaórios

