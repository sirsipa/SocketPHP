<?php

/*
 * PHP Sockets - Creare una comunicazione sockets server/client 
 */


echo "<h1>Sono il client</h1><br>";

$host    = "localhost";
$port    =10023;

$message = "Ciao come stai?";
echo "1) Confeziono il messaggio da inviare al server :<b>$message</b><br>";

$socket = socket_create(AF_INET, SOCK_STREAM, 0); 
if($socket) echo "2) Ho creato il socket con istruzione <b>socket_create(AF_INET, SOCK_STREAM, 0)</b> <br>";
     else echo "Socket NON creato<br>";

$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
if ($result) echo "3) Mi connetto al server tramite istruzione <b>socket_connect(socket, $host, $port)</b><br>";
     else echo "impossibile effettuare la connessione<br>";

socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
echo "4) Scrivo sul socket il messaggio:<b> $message</b><br>";

$result = socket_read ($socket, 1024) or die("Could not read server response\n");
echo "5) Leggo la risposta proveniente dal Server  :<b>$result</b><br>";

socket_close($socket);
echo "7) Chiudo la connessione al socket<br>";
?>