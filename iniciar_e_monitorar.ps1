# Caminho do projeto Laravel
$projeto = "C:\agendaTeste\codigo\agenda_teste"
cd $projeto

# Inicia o servidor Laravel em segundo plano (sem abrir janela de terminal)
Start-Process "php" -ArgumentList "artisan serve" -NoNewWindow -WindowStyle Hidden

# Abre o navegador
Start-Process "http://localhost:8000"

# Aguarda até que a janela do navegador (Chrome) seja fechada
do {
    Start-Sleep -Seconds 2
    $navegador = Get-Process chrome -ErrorAction SilentlyContinue
} while ($navegador)

# Encerra o servidor Laravel
Get-Process php | Stop-Process -Force
