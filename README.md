<h1>Azapfy API</h1>

<h2>API documentation for Azapfy</h2>

<h3>Exibir todas as notas</h3>
<b>URL:</b> http://<servidor>/notas
    <br>Exemplo: http://localhost:8000/notas
<h3>Agrupar as notas por remetente</h3>

<b>URL:</b> http://<servidor>/notas/agrupar
    <br>Exemplo: http://localhost:8000/notas/agrupar

<h3>Calcular o valor total das notas para cada remetente</h3>

<b>URL:</b> http://<servidor>/notas/totaisentregas
    <br>Exemplo: http://localhost:8000/notas/totaisentregas

<h3>Calcular o valor que o remetente irá receber pelo que já foi entregue</h3>
<u><li>Uma lista cnpj:total dos valores de todos os remetentes</li></u>
<b>URL:</b> http://<servidor>/notas/totaisentregas
    <br>Exemplo: http://localhost:8000/notas/totaisentregas
<ul><li>O valor total de um único remetente</li></ul>
<b>URL:</b> http://<servidor>/notas/vaireceber/cnpj-ou-cpf
    <br>Exemplo: http://localhost:8000/notas/vaireceber/66438011000166
<h3>Calcular quanto o remetente deixou de receber devido ao atraso na entrega</h3>
ou
<h3>Calcular o valor que o remetente irá receber pelo que ainda não foi entregue - não ficou claro</h3>
<ul><li>Uma lista cnpj:total dos valores com todos os remetentes que não entregaram a tempo</li></ul>
<b>URL:</b> http://<servidor>/notas/totaisnaoconcluidos
    <br>Exemplo: http://localhost:8000/notas/totaisnaoconcluidos
<ul><li>O valor total de um único remetente em falta</li></ul>
<b>URL:</b> http://<servidor>/notas/deixoudereceber/cnpj-ou-cpf
    <br>Exemplo: http://localhost:8000/notas/deixoudereceber/66438011000166
    <br>🜛
    <br>🜛
    <br>🜛
    <br>🜛
    <br>🜛
    <br>🜛
<b>Autor:</b> Fabrício Dias de Oliveira<br>
<b>Version:</b> 1.0.0<br>
