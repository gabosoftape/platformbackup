<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Detalle ruta</title>
		<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
	</head>
	<body>
		<style>
			td, th{ border: 1px solid #c6c6c6; }
			.wrap{ overflow-y: auto; }
			.odd, th{ background:#EEE; border: 1px solid #c6c6c6; }
			ul{ list-style: none; margin:0px; padding:0px; display:block;overflow-y: auto; max-height: 200px;width: 300px}
			label{ cursor:pointer; }
		</style>
		<table>
			<tr>
				<td>Empresa:</td>
				<td>
					<select id="res"></select>
					<select id="templ">
						<option value="unit_trips">Trips</option>
						<option value="unit_stays">Stays</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Unidad:</td>
				<td>
					<select id="units"></select>
				</td>
			</tr>
			<tr>
				<td>Tiempo a consultar:</td>
				<td>
					<select id="interval">
						<option value="86400" title="60 sec * 60 minutes * 24 hours = 86400 sec = 1 day">Ultimo día</option>
						<option value="604800" title="86400 sec * 7 days = 604800 sec = 1 week">Ultima semana</option>
						<option value="2592000" title="86400 sec * 30 days = 2592000 sec = 1 month">Ultimo mes</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Variables:</td>
				<td><ul id="columns"></ul></td>
			</tr>
			<tr><td colspan="2" style="text-align:center;"><input type="button" value="Execute report" id="exec_btn"/></td></tr>
		</table>
		<div id="log"></div>
		<script type="text/javascript">
			function msg(text) {
				$("#log").prepend(text + "<br/>");
			}
			function init() { // Execute after login succeed
				// specify what kind of data should be returned
				var res_flags = wialon.item.Item.dataFlag.base | wialon.item.Resource.dataFlag.reports;
				var unit_flags = wialon.item.Item.dataFlag.base;
				var sess = wialon.core.Session.getInstance(); // get instance of current Session
				sess.loadLibrary("resourceReports"); // load Reports Library
				sess.updateDataFlags( // load items to current session
					[
						{ // 'avl_resource's specification
							type: "type",
							data: "avl_resource",
							flags: res_flags,
							mode: 0
						},
						{ // 'avl_unit's specification
							type: "type",
							data: "avl_unit",
							flags: unit_flags,
							mode: 0
						}
					],
					function(code) { // updateDataFlags callback
						if (code) {// exit if error code
							msg(wialon.core.Errors.getErrorText(code));
							return;
						}
						var res = sess.getItems("avl_resource"); // get loaded 'avl_resource's items
						if (!res || !res.length) { // check if resources found
							msg("Resources not found");
							return;
						}
						for (var i = 0; i < res.length; i++) // construct Select object using found resources
							$("#res").append("<option value='" + res[i].getId() + "'>" + res[i].getName() + "</option>");
						var units = sess.getItems("avl_unit"); // get loaded 'avl_units's items
						// check if units found
						if (!units || !units.length) {
							msg("Units not found");
							return;
						}
						for (var i = 0; i < units.length; i++) // construct Select object using found units
							$("#units").append("<option value='" + units[i].getId() + "'>" + units[i].getName() + "</option>");
					}
				);
				drawCheckboxes();
				$('#templ').change(drawCheckboxes);
			}
			function drawCheckboxes () {
				// get available reports table
				wialon.core.Session.getInstance().getReportTables(function (code,data){
					var selectedTmpl = $("#templ").val();
					var col = [];
					var html = '';
					for (var i = 0; i < data.length; i++) {
						if (data[i].n == selectedTmpl) {//draw only selected report table
							col = data[i].col;
							for (var j = 0; j < col.length; j++){ // construct Select object using found report columns
								if( col[j].l != '' && col[j].n != '' ){
									html += '<li><input class="rep_col" type="checkbox" id="' + col[j].n + '" checked /><label for="' + col[j].n + '">' + col[j].l + '</label></li>';
								}
							}
						}
					};
					$('#columns').html(html);
				});
			}
			function executeReport() { // execute selected report
				// get data from corresponding fields
				var id_res = $("#res").val(),
					templ = $("#templ").val(),
					id_unit = $("#units").val(),
					time = $("#interval").val();
				if (!id_res) {
					msg("Select resource");
					return;
				} // exit if no resource selected
				if (!id_unit) {
					msg("Select unit");
					return;
				} // exit if no unit selected
				var sess = wialon.core.Session.getInstance(); // get instance of current Session
				var res = sess.getItem(id_res); // get resource by id
				var to = sess.getServerTime(); // get current server time (end time of report time interval)
				var from = to - parseInt($("#interval").val(), 10); // calculate start time of report
				var columns = $("ul li .rep_col:checked"); // get columns, that need to be in a report
				// specify time interval object
				var interval = {
					"from": from,
					"to": to,
					"flags": wialon.item.MReport.intervalFlag.absolute
				};
				var c="", cl=""; // columns and columnsLabels variables
				for(var i=0; i< columns.length; i++){ // cycle to generate columns and columnsLabels
					c += (c==""?"":",") + columns[i].id;
					cl += (cl==""?"":",") + $(columns[i].nextSibling).text();//.innerText;
				}
				$("#exec_btn").prop("disabled", true); // disable button (to prevent multiclick while execute)
				var template = {// fill template object
					"id": 0,
					"n": templ,
					"ct": "avl_unit",
					"p": "",
					"tbl": [{
							"n": templ,
							"l": $("#templ option[value='" + templ + "']").text(),
							"c": c,
							"cl": cl,
							"s": "",
							"sl": "",
							"p": "",
							"sch": {
								"f1": 0,
								"f2": 0,
								"t1": 0,
								"t2": 0,
								"m": 0,
								"y": 0,
								"w": 0
							},
							"f": 0
						}]
				};
				res.execReport(template, id_unit, 0, interval, // execute selected report
				function(code, data) { // execReport template
					$("#exec_btn").prop("disabled", false); // enable button
					if (code) {
						msg(wialon.core.Errors.getErrorText(code));
						return;
					} // exit if error code
					if (!data.getTables().length) { // exit if no tables obtained
						msg("<b>There is no data generated</b>");
						return;
					} else showReportResult(data); // show report result
				});
			}
			function showReportResult(result) { // show result after report execute
				var tables = result.getTables(); // get report tables
				if (!tables) return; // exit if no tables
				for (var i = 0; i < tables.length; i++) { // cycle on tables
					// html contains information about one table
					var html = "<b>" + tables[i].label + "</b><div class='wrap'><table style='width:100%'>";
					var headers = tables[i].header; // get table headers
					html += "<tr>"; // open header row
					for (var j = 0; j < headers.length; j++) // add header
						html += "<th>" + headers[j] + "</th>";
					html += "</tr>"; // close header row
					result.getTableRows(i, 0, tables[i].rows, // get Table rows
						function(code, rows) { // getTableRows callback
							if (code) {
								msg(wialon.core.Errors.getErrorText(code));
								return;
							} // exit if error code
							for (var j in rows) { // cycle on table rows
								if (typeof rows[j].c == "undefined") continue; // skip empty rows
								html += "<tr" + (j % 2 == 1 ? " class='odd' " : "") + ">"; // open table row
								for (var k = 0; k < rows[j].c.length; k++) // add ceils to table
									html += "<td>" + getTableValue(rows[j].c[k]) + "</td>";
								html += "</tr>"; // close table row
							}
							html += "</table>";
							msg(html + "</div>");
						},
					this,html);
				}
			}
			function getTableValue(data) { // calculate ceil value
				if (typeof data == "object")
					if (typeof data.t == "string") return data.t;
					else return "";
					else return data;
			}
			// execute when DOM ready
			$(document).ready(function() {
				$("#exec_btn").click(executeReport); // bind action to button click
				wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
				// For more info about how to generate token check
				// http://sdk.wialon.com/playground/demo/app_auth_token
				wialon.core.Session.getInstance().loginToken("df55b9c1f05f51d44224c6b85cb2bc90798E462B6216DEBFDA454D9E3A94C2362E01E890", "", // try to login
				function(code) { // login callback
					// if error code - print error message
					if (code) {
						msg(wialon.core.Errors.getErrorText(code));
						return;
					}
					msg("Ingreso permitido");
					init(); // when login suceed then run init() function
				});
			});
		</script>
	</body>
</html>