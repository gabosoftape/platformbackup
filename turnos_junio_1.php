<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
<style>
	td, th{ border: 1px solid #c6c6c6; }
	.wrap{ max-height:150px; overflow-y: auto; }
	.odd, th{ background:#EEE; border: 1px solid #c6c6c6; }
</style>
<div id="log"></div>
<script type="text/javascript">
function msg(text){ $("#log").prepend(text + "<br/>"); }
function init(){
	var res_flags = wialon.item.Item.dataFlag.base | wialon.item.Resource.dataFlag.reports;
	var unit_flags = wialon.item.Item.dataFlag.base;
	var sess = wialon.core.Session.getInstance();
	sess.loadLibrary("resourceReports");
	sess.updateDataFlags( 
		[{type: "type", data: "avl_resource", flags:res_flags , mode: 0}, 
		 {type: "type", data: "avl_unit", flags: unit_flags, mode: 0}], 
		function (code) { 
			if (code) { msg(wialon.core.Errors.getErrorText(code)); return; }
			var res = sess.getItems("avl_resource");
			for (var i = 0; i< res.length; i++){
				$("#res").append("<option value='" + res[i].getId() + "'>" + res[i].getName() + "</option>");
			}
			var units = sess.getItems("avl_unit");
			for (var i = 0; i< units.length; i++){
				// $("#units").append("<option value='"+ units[i].getId() +"'>"+ units[i].getName()+ "</option>");
				console.log(units[i].getId() +' - ' + units[i].getName());
				executeReport(13935935);
			}
		}
	);
}
function executeReport(vehiculoid){ 
	var id_res=15136513, id_templ=8, id_unit=vehiculoid, time=86400;
	var sess = wialon.core.Session.getInstance();
	var sess = wialon.core.Session.getInstance();
	var res = sess.getItem(id_res);
	var to = sess.getServerTime();
	var from = to - parseInt(86400, 10);
	
	var interval = { "from": from, "to": to, "flags": wialon.item.MReport.intervalFlag.absolute };
	var template = res.getReport(id_templ); 
	$("#exec_btn").prop("disabled", true); 

	res.execReport(template, id_unit, 0, interval, 
		function(code, data){
			if(data.getTables() !== undefined ){
				if(!data.getTables().length){ 
					// msg("<table><tr><td><b>Hay datos para mostrar vehículo " + vehiculoid + "Nombre Vehículo: " + nombre + "</b></td></tr></table>"); 
					// return;
				}
				else{
					var tables = data.getTables();
					for(var i in tables){ 
						var html = "<div class='wrap'><table style='width:100%'>";
						
						var headers = tables[i].header; 
						data.getTableRows(i, 0, tables[i].rows, 
							qx.lang.Function.bind(function(html, code, rows){ 
								for(var j in rows){
									html += "<tr"+(j%2==1?" class='odd' ":"")+">"; 
									html += "<td>ID: " + id_unit;
									// html += "<td>Unidad: " + nombre + "</td>";
									for(var k in rows[j].c){
										html += "<td>" + getTableValue(rows[j].c[k]) + "</td>";
									}
									html += "</tr>";
								}
								html += "</table>";
								msg(html +"</div>");
							}, this, html)
						);
					}
				}
			}
	});
}
function getTableValue(data) {
	if (typeof data == "object")
		if (typeof data.t == "string") return data.t; else return "";
	else return data;
}
$(document).ready(function (){
	$("#exec_btn").click( executeReport );
	wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com");
	wialon.core.Session.getInstance().loginToken("df55b9c1f05f51d44224c6b85cb2bc9067DE5B102D3D8B6894E507107235833254029AF6", "", // try to login
		function (code) { 
			if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
			init();
	});
});
</script>