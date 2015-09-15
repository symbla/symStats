<?php 
		function mkSqlBasic($ts_host, $ts_user, $ts_pw, $ts_db, $ts_table) {	
			$ts_connect          = mysql_connect($ts_host, $ts_user, $ts_pw);
			if(!$ts_connect) die(mysql_error());
			$ts_select_db        = mysql_select_db($ts_db, $ts_connect);
			if(!$ts_select_db) die(mysql_error());
		}
		
		function buildSqlQuery($ts_akt_date, $ts_table) {
			global $ts_sa_query;
			global $uri;
			if(!isset($_GET['tzone']) || empty($_GET['tzone'])) {
				echo "<script type='text/javascript'> window.location='?tzone=$ts_akt_date'; </script>";
			} elseif($_GET['tzone'] == "all") {
				$ts_sa_query = mysql_query("SELECT * FROM `".$ts_table."` ORDER BY `".$ts_table."`.`ERSTER_AUFRUF` DESC");
        $uri = "?tzone=all";
			} else {
        $ts_sa_query = mysql_query("SELECT * FROM `".$ts_table."` WHERE ERSTER_AUFRUF LIKE ('%".$_GET['tzone']."%') ORDER BY `".$ts_table."`.`ERSTER_AUFRUF` DESC");
			  $uri = "?tzone=".$_GET['tzone']."";
			}
		}
		
		function getOverviewEntryData() {
			$ts_oed_fetch = mysql_fetch_array("SELECT * FROM $ts_table WHERE ID='".$tr_entry_id."'");
			$ts_oed_rows = mysql_num_rows($ts_oed_fetch);
			$ts_oed_rows = $ts_oed_rows-1;
			
			$ts_oed_ip      = $ts_oed_rows[1];
			$ts_oed_sprache = $ts_oed_rows[2];
			$ts_oed_agent   = $ts_oed_rows[3];
			$ts_oed_pos     = explode("[", $ts_oed_rows[4]);
			$ts_oed_fcon    = explode(",", $ts_oed_rows[5]);
			$ts_oed_cons    = $ts_fa_rows[6];
			$ts_oed_lcon    = $ts_fa_rows[7];
			$ts_oed_chr     = $ts_fa_rows[8];
		}
		
		function getTableEntryData($ts_sa_query, $uri) {
			$ts_fa_query   = mysql_fetch_array($ts_sa_query);
			$ts_nr_query   = mysql_num_rows($ts_sa_query);
			$ts_nr_query 	 = $ts_nr_query-1;
			if($ts_nr_query=="0") {
				echo "<span style='display: block; width: 100%; text-align: center; padding: 10px 0;'>Keine Einträge gefunden.</span>";
			} else {
				for($i=0;$i<=$ts_nr_query;$i++) {
					if(($i%2)=="0") $tr_color = "#EEE"; else $tr_color = "#FFF";
			
					$ts_tr_id      = $ts_fa_query[0];
					$ts_tr_ip      = $ts_fa_query[1];
					$ts_tr_sprache = $ts_fa_query[2];
					$ts_tr_agent   = $ts_fa_query[3];
					$ts_tr_pos     = explode("[", $ts_fa_query[4]);
					$ts_tr_fcon    = explode(",", $ts_fa_query[5]);
					$ts_tr_cons    = $ts_fa_query[6];
					$ts_tr_lcon    = $ts_fa_query[7];
					$ts_tr_chr     = $ts_fa_query[8];
			
					echo "\n<tr style='background: $tr_color;'>";
					echo "<td style='text-align: center;'><p>".($i+1)."</p></td>";
					echo "<td style='width: 30px; text-align: center;'><a href='$uri&show=$ts_tr_id'><img src='./img/application.png' border='0' title='Eintrag anzeigen'></a></td>";
					echo "<td><p>".$ts_tr_fcon[0]."<br />".$ts_tr_fcon[1]."</p></td>";
					echo "<td><p>$ts_tr_ip</p></td>";
					echo "<td><p>".$ts_tr_pos[0]."</p></td>";
					echo "<td><p>$ts_tr_cons</p></td>";
					echo "<td style='width: 30px; text-align: center;'><a href='$uri&del=$ts_tr_id'><img src='./img/delete.png' border='0' title='Eintrag löschen'></a></td>";
					echo "</tr>";
				}
			}
		}
?>