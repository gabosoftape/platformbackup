<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Wialon Playground - Bind driver to unit</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
</head>
<body>
<style>
#units tr td, #units { 
  border: 1px solid #c6c6c6; 
}
</style>


Units and its drivers:
<table id='units'>
</table>
<div id="log"></div>


<script type="text/javascript">
// Print message to log
function msg(text) { $("#log").prepend(text + "<br/>"); }

function init() { // Execute after login succeed
	var sess = wialon.core.Session.getInstance(); // get instance of current Session
	// flags to specify what kind of data should be returned
	var unit_flags = wialon.util.Number.or(wialon.item.Item.dataFlag.base),
		res_flags =  wialon.util.Number.or(wialon.item.Item.dataFlag.base, wialon.item.Resource.dataFlag.drivers);
	
	// load Icon & Driver Library 
	sess.loadLibrary("resourceDrivers");
	sess.loadLibrary("itemIcon");
	
	// load items to current session
	sess.updateDataFlags( 
		[{type: "type", data: "avl_unit", flags: unit_flags, mode: 0}, 
		 {type: "type", data: "avl_resource", flags: res_flags, mode: 0}], 
		function (code) { // updateDataFlags callback
    		if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code

			// get loaded 'avl_unit's items  
	    	var units = sess.getItems("avl_unit");
    		if (!units || !units.length){ msg("Units not found"); return; } 

			// get loaded 'avl_resource's items  
			var ress = sess.getItems("avl_resource"); // get loaded 'avl_resource's items
			if (!ress || !ress.length){ msg("Resours not found"); return; } 
			
			var select = "", // html-string of any select object
				all_drivers = {}, // object with all drivers info
				d_obj; // any element of all_drivers list 
			for (var j = 0; j< ress.length; j++) {
				var res = ress[j], // get loaded 'avl_resource's items
					drivers = res.getDrivers() || {}; // get loaded driver`s items from any resource
				for (var drv in drivers) {
					driver = drivers[drv]; // iterate all drivers
					select += "<option value='" + res.getId() + '_' + driver.id + "'>"+ driver.n+ "</option>";  // append option to select object for any row
					
					// any element of all_drivers list 
					d_obj = {
							id: driver.id,
							name: driver.n,
							icon: res.getDriverImageUrl(driver, 32)
					    };
						
					// all_drivers list consists from bind unit key and array of drivers 
					if (!all_drivers[driver.bu])
						all_drivers[driver.bu] = [d_obj]; // if first element
					else 
					    all_drivers[driver.bu].push(d_obj); // if next element
				}
			}
			// construct table data using found units
			for (var i = 0; i< units.length; i++){ 
				var u = units[i], 
					u_id = u.getId(), // id of current unit
					row = ""; // html-string of any row in table
				
				// begin row html-string
				row += "<tr><td>"; 
				row += "<img class='icon' src='" + u.getIconUrl(16) + "' alt='icon'/>";
				row += "</td><td>" + u.getName() + "</td><td id='drivers_" + u_id + "'>";
					
				if (typeof all_drivers[u_id] != "undefined") { // check, bind driver to unit or no
					array = all_drivers[u_id]; // read regular array of drivers
					for (var k = 0, len = array.length; k < len; k++) {
						d_obj = array[k]; // read any element of array and build div with info about driver
						row += "<div class='driver_info' id='driver_info_" +  + d_obj.id + "' >";
						row += "<img class='icon' src='" + d_obj.icon  + "' alt='icon'/>";
						row += "   " + d_obj.name + "</div>"; 
					}
				}
				
				row += "</td><td><select id='select_" + u_id + "'>" + select + "</select></td>"; // append select
				row += "<td><input id='" + u_id + "' type='button' value='Bind / Unbind'></td></tr>";  //append bind-button
				
				$("#units").append(row); // append formating row
				$("#" + u_id).on("click", bind_driver); // add event click on button
			}
	    }
	);
}

function bind_driver (event)
{
	// get all params
	var sess = wialon.core.Session.getInstance(), // session
	u_id = event.target.id, // unit id
	unit = sess.getItem(u_id), // // get unit by id  
	res_driver = $("#select_" + u_id).val(), // resource and driver contains in select option
	arr = res_driver.split("_"), // break it in array
	resId = arr[0], // get resource id
	driverId = arr[1], // get driver id
	res = sess.getItem(resId), // // get resource by id  
	driver = res.getDriver(driverId), // get driver by id
	isBind = driver.bu != u_id; // check, bind driver or not
	
	// bind driver to unit
	res.bindDriverToUnit(driver, unit, 0, isBind, qx.lang.Function.bind(function(res, driver, code, result) {
	if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code	    
		// update info about driver in table
		$("#driver_info_" + driver.id).remove();
		if (isBind) {
			var info_str = "<div class='driver_info' id='driver_info_" +  + driver.id + "' >";
				info_str += "<img class='icon' src='" + res.getDriverImageUrl(driver, 32);
				info_str += "' alt='icon'/>" + "   " + driver.n + "</div>"
			$("#drivers_" + u_id).append(info_str);
		}    
	}, this, res, driver));
}

// execute when DOM ready
$(document).ready(function () {
	wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
    // For more info about how to generate token check
    // http://sdk.wialon.com/playground/demo/app_auth_token
	wialon.core.Session.getInstance().loginToken("<?php echo $_GET['access_token'];?>", "", // try to login
		function (code) { // login callback
			// if error code - print error message
			if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
			msg("Logged successfully"); init(); // when login suceed then run init() function
	});
})
</script>
</body>
</html>