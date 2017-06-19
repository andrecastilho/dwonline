
    <?php
$host="prosp.chl209etmtnz.sa-east-1.rds.amazonaws.com";
$port=3306;
$socket="";
$user="sistema";
$password="somethingsecure";
$dbname="dataWebProducao";


 $time_beg = microtime (true);


$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

	$query = "call dataWebProducao.rd_dadospf(353)";

if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($field1, $field2, $field3, $field4);
    while ($stmt->fetch()) {
       // printf("%s, %s\n, %s\n", $field1, $field2, $field3);
	   echo $field2."<br>";
    }
    $stmt->close();
}




//coloque sua consulta aqui

$time_end = microtime (true);

$time_res = $time_end - $time_start ;

echo " a consulta levou US ".$time_res." segundos "; 


/*$con1 = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

	$query = "call dataWebProducao.rd_tels(353)";

if ($stmt = $con1->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($field1, $field2, $field3);
    while ($stmt->fetch()) {
       // printf("%s, %s\n, %s\n", $field1, $field2, $field3);
	   echo $field3."<br>";
    }
    $stmt->close();
}
	

$con->close();
$con1->close();

	
	
	
	$conecta = mysql_connect("prosp.chl209etmtnz.sa-east-1.rds.amazonaws.com", "sistema", "somethingsecure") or print (mysql_error()); 
	mysql_select_db("dataWebProducao", $conecta) or print(mysql_error()); 

	#procedure para buscar clientes
	$sql = "call rd_empresas()";  
	$result = mysql_query($sql) or die("Falha na execução da consulta Clientes<br>" .mysql_error());
				
		   $query_pag_num = mysql_num_rows($result);
		   if($query_pag_num > 0){
			   while ($row = mysql_fetch_assoc($result)) {
			
				//variaveis do resultado da consulta
				$campo1	= $row['idtb_empresa'];		
				$campo2	= $row['tb_empresa_cnpj'];
				$campo3	= $row['tb_empresa_nome'];
				$campo4	= $row['tb_empresa_qtd_usuarios'];
				
	                ?>
				
				
                  <td><?php echo $campo1; ?></td>
                  <td><?php echo $campo2; ?></td>
                  <td><?php echo $campo3; ?></td>
                  <td><?php echo $campo4."<br>"; ?></td>
  

				
		   <?php } }
				mysql_close($conecta); 
				
				?>
                
	
	
	
	*/
	
	
	
	?>
                
              
  

  