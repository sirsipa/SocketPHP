<?php
if (!($sock = socket_create(AF_INET, SOCK_STREAM, 0))) {
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);    
    die("Creazione del socket non riuscita: [$errorcode] $errormsg \n");
}
echo "Socket creato correttamente. \n";

// Bind dell'indirizzo
if ( !socket_bind($sock, "127.0.0.1" , 60000)) {
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);    
    die("Bind non riuscito: [$errorcode] $errormsg \n");
}
echo "Bind del socket OK \n";

if (!socket_listen ($sock , 10)) {
	$errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);    
    die("Ascolto del socket non riuscito : [$errorcode] $errormsg \n");
}
echo "Ascolto del socket OK. \n";
echo "In attesa dell'arrivo delle connessioni... \n";

// Accettazione delle connessioni in arrivo - Questa è una chiamata di blocco
$client = socket_accept($sock);
	
// Visualizza le informazioni del client connesso
if(socket_getpeername($client , $address , $port)) {
	echo "Client $address : $port risulta collegata.";
}

socket_close($client);
socket_close($sock);
?>