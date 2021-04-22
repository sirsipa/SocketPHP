<?php
//$vet=array(0,0,0,0,0,0,0); //array vuoto da acquisire dal client
echo "<h1>Sono il Server </h1><br>";
echo "PASSI PER LA GESTIONE DEL SOCKET<BR>";

$host = "localhost";
$port = 10025;

set_time_limit(0);   // nessul limite per il timeout

$socket = socket_create(AF_INET, SOCK_STREAM, 0);
if ($socket) echo "1) Ho creato il socket con istruzione <b>socket_create(AF_INET, SOCK_STREAM, 0)</b> <br>";
     else echo "Socket NON creato<br>";


$result = socket_bind($socket, $host, $port);
 if($result) echo "2) Ho effettuato il binding con istruzione <b>socket_bind(socket, $host, $port)</b><br>";
   else echo "bind Fallito<br>";


$result = socket_listen($socket, 3);
echo "3) Mi pongo in ascolto con istruzione <b>socket_listen(socket, 3)</b><br>";

$spawn = socket_accept($socket) or die("Could not accept incoming connection\n");
echo "4) Accetto la connessione con istruzione <b>socket_accept(socket)</b><br>";

// ----- chiedo al client di inviarmi tutto l'array
$output ="inviami tutto array?";
socket_write($spawn, $output, strlen ($output)) or die("Could not write output\n");
echo "6) Scrivo sul socket il mio messaggio  da inoltrare al client: <b>$output</b><br>";
//--------------------------

//------- leggo il pacchetto proveniente dal client
$input = socket_read($spawn, 1024) or die("Could not read input\n");
$input = trim($input);
echo "5) pacchetto arrivato dal client <b>$input</b><br>";
//-------------------------------

// scompatto il pacchetto e creo l'array

$vet=explode(",", $input);

//stampo il vettore acquisito dal client
echo "Vettore proveniente dal client<br>";

print_r($vet);

//for($i=0;$i<$vet.length;$i++)
//{
//echo $vet[$i]."-";
 //}
//echo "<br>";


socket_close($spawn);
socket_close($socket);
echo "7) Chiudo la connessione, il server elimina il socket<br>";
?>