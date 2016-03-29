<?
//			$conn = pg_connect("host=192.168.4.10 port=5432		dbname=inscripcion2 user=postgres password=CatDerykasd");
			$conn = pg_connect("host=localhost port=5432		dbname=soporte user=postgres password=postgres");
							if ($conn) {
									// print pg_host($conn);
									} else {
									 echo pg_last_notice($conn);
									 exit;
										}?>