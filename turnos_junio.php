<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js?callback=getUnits()"></script>
<style>
td, th{ border: 1px solid #c6c6c6; }
.wrap{ max-height:150px; overflow-y: auto; }
.odd, th{ background:#EEE; border: 1px solid #c6c6c6; }
</style>
<div id="log"></div>
<script>
var id_res = 15136513;
var id_unit = 13953872;
function msg(text) { $("#log").prepend(text + "<br/>"); }
function init(time){
	console.log(time);
	var res_flags = wialon.item.Item.dataFlag.base | wialon.item.Resource.dataFlag.reports;
	var unit_flags = wialon.item.Item.dataFlag.base;
	var sess = wialon.core.Session.getInstance();
	sess.loadLibrary("resourceReports");
	sess.updateDataFlags(
		[{type: "type", data: "avl_resource", flags:res_flags , mode: 0},
		 {type: "type", data: "avl_unit", flags: unit_flags, mode: 0}],
		function (code){ 
			executeReport(id_res, id_unit, time);
		}
	);
}
function executeReport(id_res, id_unit, time){ 
	var id_res=id_res, id_templ=8, id_unit=id_unit, time=time;
	var sess = wialon.core.Session.getInstance(); 
	var res = sess.getItem(id_res); 
	var to = sess.getServerTime(); 
	var from = to - parseInt(time,10);
	var interval = { "from": from, "to": to, "flags": wialon.item.MReport.intervalFlag.absolute };
	var template = res.getReport(id_templ);
	res.execReport(template, id_unit, 0, interval, 
	function(code, data) { 
		if(code){ 
			msg(wialon.core.Errors.getErrorText(code)); 
			return; 
		} 
		if(!data.getTables().length){ 
			msg("<b>There is no data generated</b>"); 
			return; 
		}
		else{
			showReportResult(data);
		}
	});
}
function showReportResult(result){ 
	var tables = result.getTables(); 
	if (!tables) return; 
	for(var i=0; i < tables.length; i++){ 
		var html = "<div class='wrap'><table style='width:100%'>";
		var headers = tables[i].header; 
		html += "<tr>"; 
		for (var j=0; j<headers.length; j++) 
			html += "<th>" + headers[j] + "</th>";
		html += "</tr>"; 
		result.getTableRows(i, 0, tables[i].rows, 
			qx.lang.Function.bind( function(html, code, rows) { 
				if (code) {msg(wialon.core.Errors.getErrorText(code)); return;} 
				for(var j in rows) { 
					if (typeof rows[j].c == "undefined") continue; 
					html += "<tr"+(j%2==1?" class='odd' ":"")+">"; 
					for (var k = 0; k < rows[j].c.length; k++) 
						html += "<td>" + getTableValue(rows[j].c[k]) + "</td>";
					html += "</tr>";
				}
				html += "</table>";
				msg(html +"</div>");
			}, this, html)
		);
	}
}
function getTableValue(data) {
	if (typeof data == "object")
		if (typeof data.t == "string") return data.t; else return "";
	else return data;
}
</script>

<script>
$(document).ready(function () {
	wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com");
	wialon.core.Session.getInstance().loginToken("df55b9c1f05f51d44224c6b85cb2bc90C5CBB0DE86AA477EF71F278538D20510041637D0", "", 
		function (code){ 
			if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
			<?php 
				for($i=0; $i<=86400; $i = $i + 675){
					echo 'init('.$i.');';
				}
			?>
	});
});
</script>