<?php include 'conectatm.php'; ?>



<?php

            	//consultamos las noticias
				
				$sql_news = "	SELECT	*
                                                FROM	eventosTicket	
                                              								
                                                ORDER BY eventoId ASC
				   	        LIMIT 80";
					
									
								   $rs_news = $conn->Execute($sql_news) or die("Fallo la consulta de noticias <h2>:( </h2>");
								//echo $sql_news;
								$i=1;
								while($row_news = $rs_news->FetchRow())
								{
		      
						 
						echo	"  
						
						
	
	
	
<tr>
      <td class='eventos'>".$row_news['eventoNombre']."</td>
      <td>".$row_news['eventoLugar']."</td>
      <td>".$row_news['tipoBoleto']."</td>
      <td>".$row_news['nivelVenta']."</td>
      <td>".$row_news['eventoClave']."</td>
      <td class='eventos'><em>".$row_news['precioNormal']."</em></td>
      <td class='eventos'><em>".$row_news['precioBum']."</em></td>
     </tr>						
						
		";
		
		
	
		
		
					
					
						
				
				$i++;
				}				

 
?>