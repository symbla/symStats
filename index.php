<?php
	$ts_akt_date = date("d.m.Y", time());
	$ts_exp_date = explode(".", $ts_akt_date);
	$ts_time = date("H:i:s", time());

	require_once("./bin/php/config.php");
	require_once("./bin/php/mysql.lib.php");
	require_once("./bin/php/gui.lib.php");
  
	mkSqlBasic($MySQL_Server, $MySQL_Benutzer, $MySQL_Passwort, $MySQL_Datenbank, $MySQL_Tabelle);
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>#TrackStat</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" src="http://use.edgefonts.net/abel.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript" src="./bin/js/default.lib.js"></script>
		<script type="text/javascript" src="./bin/js/ani.lib.js"></script>
      
		<link rel="stylesheet" type="text/css" href="./bin/css/symbox.css" />                                                         
   </head>
	<body>
      <?php
			buildSqlQuery($ts_akt_date, $MySQL_Tabelle);
      ?>
		<div class="sym-grid">
			<div class="col-1-1">
				<h3 class="txt-center">symStats</h3>
			</div>
		</div>
		<div class="sym-grid">
			<div class="col-2-10">
				<div class="panel" id="calendar">
					<div class="panel-head bg-grey"><p>Kalender</p></div>
					<div class="panel-body">
						<?php getCalendar(); ?> 
					</div>
				</div> 
			</div>
			<div class="col-3-10">
				<div class="panel">
					<?php
						if(isset($_GET['tzone']) && $_GET['tzone'] != "all") {
							$ts_overview = $_GET['tzone'];
						} else {
							$ts_overview = "Alle Einträge";
						}
					?>
					<div class="panel-head bg-grey"><p>Übersicht: <b><? echo $ts_overview; ?></b></p></div>
					<div class="panel-body">
						<?php
							getOverview();
						?>
					</div>
				</div>
				<?php
					if(isset($_GET['show'])) {
						$showid = $_GET['show'];
				?>
				<div class="panel">
					<div class="panel-head bg-grey"><p>Informationen</p></div>
					<div class="panel-body"></div>
				</div>
				<?php
					}
				?>     
			</div>
			<div class="col-5-10">
				<div class="panel">
					<div class="panel-head bg-grey"><p>symTrack Datentabelle</p></div>
					<div class="panel-body">
						<table>
							<thead>
								<tr>
									<td style="width: 30px;"></td>
									<td style="width: 30px;"></td>
									<td style="padding-left: 2px;"><p>Verbindung</p></td>
									<td style="padding-left: 2px;"><p>IP</p></td>
									<td style="padding-left: 2px;"><p>Position</p></td>
									<td style="text-align: center;"><p>Aufrufe</p></td>
									<td style="width: 30px;"></td>
								</tr>  
							</thead>
							<tbody>
							<?php                   
								echo $ts_sa_query.$uri;
								getTableEntryData($ts_sa_query, $uri);
							?>  
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div> <!-- /sym-grid -->
	</body>
</html>
