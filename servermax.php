<html>
<head><title>Test Php - Server Socket</title>
<body>
<?php 
if (!($sock = socket_create(AF_INET, SOCK_STREAM, 0))) 
{ 
 $errorcode = socket_last_error(); 
 $errormsg = socket_strerror($errorcode); 
die("Creazione del socket non riuscita: [$errorcode] $errormsg \n"); 
} 
echo "Socket creato correttamente. \n"; 
// Bind dell'indirizzo 
if ( !socket_bind($sock, "127.0.0.1" , 5000) ) 
{ 
 $errorcode = socket_last_error(); 
 $errormsg = socket_strerror($errorcode); 
die("Bind non riuscito : [$errorcode] $errormsg \n"); 
} 
echo "Bind del socket OK \n"; 
// Attivazione ascolto del socket 
if (!socket_listen ($sock , 10)) 
{ 
 $errorcode = socket_last_error(); 
 $errormsg = socket_strerror($errorcode); 
die("Ascolto del socket non riuscito : [$errorcode] $errormsg \n"); 
} 
echo "Ascolto del socket OK. \n"; 
echo "In attesa dell'arrivo delle connessioni... \n"; 
// Accettazione delle connessioni in arrivo - Questa è una chiamata di blocco 
$client = socket_accept($sock); 
// Visualizzazione delle informazioni del client che si è connesso 
if (socket_getpeername($client , $address , $port)) 
{ 
 echo "Client $address : $port risulta collegato. \n"; 
} 
$message="Inserisci i voti\n\r";
socket_write($client, $message);
// Lettura dei dati in arrivo dal socket 
$input1=socket_read($client, 1024);
$voti[0] = $input1;
socket_write($client,"\n \r");
$input2=socket_read($client, 1024);
$voti[1] = $input2;
socket_write($client,"\n \r");
$input3=socket_read($client, 1024);
$voti[2] = $input3;
socket_write($client,"\n \r");
$input4=socket_read($client, 1024);
$voti[3] = $input4;
socket_write($client,"\n \r");
$max=$voti[0];
for($I=1;$I<=3;$I++){
           if($voti[$I]>$max)
             {
              $max=$voti[$I];
              }
                 }
$response= " voto massimo= $max \n\r";
//viene visualizzato il massimo voto
socket_write($client,$response);
 
socket_close($client); 
?>
</body>
</html>