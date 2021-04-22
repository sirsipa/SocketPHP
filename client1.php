<?php

/*
 * PHP Sockets - Creare una comunicazione sockets server/client 
 */


echo "<h1>Sono il client</h1><br>";

$host    = "localhost";
$port    =10023;

$message = 7;
// echo "1) Confeziono il messaggio da inviare al server :<b>$message</b><br>";

$ar = array(70,80,90,100,110,120,130);  //valori da inviare al server
echo "devo inviare al server questo array singolarmente (70,80,90,100,110,120,130)<br><br>";

$socket = socket_create(AF_INET, SOCK_STREAM, 0); 
if($socket) echo "2) Ho creato il socket con istruzione <b>socket_create(AF_INET, SOCK_STREAM, 0)</b> <br>";
     else echo "Socket NON creato<br>";

$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
if ($result) echo "3) Mi connetto al server tramite istruzione <b>socket_connect(socket, $host, $port)</b><br>";
     else echo "impossibile effettuare la connessione<br>";

// ------ leggo dal server il messaggio per sapere quanti numeri inserire
$result = socket_read ($socket, 1024) or die("Could not read server response\n");
echo "5) Leggo il messagio proveniente dal Server  :<b>$result</b><br>";
//---------

//---- invio al server il numero di valori
socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
echo "4) Invio al server numero di valori:<b> $message</b><br>";
//--------------

for($i=0;$i<$message;$i++)
{
// ------ leggo dal server il messaggio per acquisire il singolo valore
$result = socket_read ($socket, 1024) or die("Could not read server response\n");
echo "5) Leggo il messagio proveniente dal Server  :<b>$result</b><br>";
//---------

//---- invio al server il singolo valore
$val=$ar[$i];
socket_write($socket,$val , strlen($val)) or die("Could not send data to server\n");
echo "4) Invio al server il singolo valore:<b> $val</b><br>";
//--------------

 }
socket_close($socket);
echo "7) Chiudo la connessione al socket<br>";
?>