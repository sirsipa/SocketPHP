<?php

/*
 * PHP Sockets - Creare una comunicazione sockets server/client 
 */


echo "<h1>Sono il client</h1><br>";

$host    = "localhost";
$port    =10025;

$count = 7;
// echo "1) Confeziono il messaggio da inviare al server :<b>$message</b><br>";

$ar = array(70,80,90,100,110,120,130);  //valori da inviare al server
echo "devo inviare al server questo array IN UNICO INVIO (70,80,90,100,110,120,130)<br><br>";

$socket = socket_create(AF_INET, SOCK_STREAM, 0); 
if($socket) echo "2) Ho creato il socket con istruzione <b>socket_create(AF_INET, SOCK_STREAM, 0)</b> <br>";
     else echo "Socket NON creato<br>";

$result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");  
if ($result) echo "3) Mi connetto al server tramite istruzione <b>socket_connect(socket, $host, $port)</b><br>";
     else echo "impossibile effettuare la connessione<br>";

// ------ leggo dal server il messaggio per sapere cosa vuole
$result = socket_read ($socket, 1024) or die("Could not read server response\n");
echo "5) Leggo il messagio proveniente dal Server  :<b>$result</b><br>";
//---------

// confeziono unico messagio in cui invio il numero di elementi e i singoli valori cioè
//  7,70,80,90,100,110,120,130

$message="";
for($i=0;$i<$count;$i++)
 $message.="$ar[$i],";
 
//---- invio al server array completo
socket_write($socket, $message, strlen($message)) or die("Could not send data to server\n");
echo "4) Invio al server tutto il pacchetto:<b> $message</b><br>";
//--------------


socket_close($socket);
echo "7) Chiudo la connessione al socket<br>";
?>