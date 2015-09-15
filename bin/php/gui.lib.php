<?php
	function getCalendar() {	
						$ts_cal_today = date(d);
            $ts_cal_days = date(t);
            $ts_cal_month = date(m);
            $ts_cal_year = date(Y);
            $ts_cal_firstday = mktime(0, 0, 1, $ts_cal_month,1, $ts_cal_year);
            $ts_cal_lastday = mktime(0, 0, 1,$ts_cal_month, $ts_cal_days, $ts_cal_year);
            $ts_cal_first = date(w, $ts_cal_firstday);
            $ts_cal_last = date(w, $ts_cal_lastday);
            $ts_cal_diff = 7 - $ts_cal_last;
            $ts_cal_jahr = date(Y);      
            $ts_cal_months = array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
            $ts_cal_monat = $ts_cal_months[date("n", time())-1];   
               
            if($ts_cal_first == 0) $ts_cal_first = 7;
            if($ts_cal_last == 0) $ts_cal_last = 7;         
            for($ts_cal_i=1; $ts_cal_i<$ts_cal_first; $ts_cal_i++) {
              $ts_cal_begin.= "<td><p></td>";
            }       
            for($ts_cal_i=0; $ts_cal_i<$diff; $ts_cal_i++) {
              $ts_cal_end.= "<td><p></td>";
            }
            if(strlen($ts_cal_monat) > "7") { $ts_cal_mfsize = "15pt;"; } else { $ts_cal_mfsize = "17pt;"; }         
            echo "<div id='leftcal'>
            <p style='display: block; width: 100%; text-align: center; font-weight: bold;'>$ts_cal_monat $ts_cal_jahr</p>
            </div>";
            echo "<div id='rightcal'>
            <table>
            <thead>
					<tr style='text-align: center;'>
						<td><p>Mo</p></td>
						<td><p>Di</p></td>
						<td><p>Mi</p></td>
						<td><p>Do</p></td>
						<td><p>Fr</p></td>
						<td><p>Sa</p></td>
						<td><p>So</p></td>
					</tr>
            </thead>
            <tr>
            $ts_cal_begin";         
            for($ts_cal_i=1; $ts_cal_i<($ts_cal_days+1); $ts_cal_i++) {
              if($ts_cal_first == 0):
                echo "<tr>";
              endif;
              if(strlen($ts_cal_i)=="1") $ts_cal_i = "0$ts_cal_i";
              if($_GET['tzone']=="$ts_cal_i.$ts_cal_month.$ts_cal_year") {
                echo "<td align='center'><p>$ts_cal_i</p></td>";
              }
              else {
                echo "<td align='center'><p><a href=\"?tzone=$ts_cal_i.$ts_cal_month.$ts_cal_year\">$ts_cal_i</a></p></td>";
              }
              if($ts_cal_first==7):
                echo "</tr><tr>";
                $ts_cal_first=0;
              endif;
              $ts_cal_first++;           
            }          
            echo "$ts_cal_end</tr>";
            echo "</table></div>";   
	}
	
	function getOverview() {
		
	}
?>