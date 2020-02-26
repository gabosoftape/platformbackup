<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Wialon Playground - Geofence parameters</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
</head>
<body>
<style>
#log {
  border: 1px solid #c6c6c6;
}
</style>


Resources: <select id="res"><option></option></select>
Select geofence:<select id="zones"><option></option></select>
<div id="log"></div>


<script type="text/javascript">
// Print message to log
function msg(text) { $("#log").prepend(text + "<br/>"); }

function init(){ // Execute after login succeed
	var sess = wialon.core.Session.getInstance(); // get instance of current Session
	//specify what kind of data should be returned   
	var flags = wialon.item.Item.dataFlag.base | wialon.item.Resource.dataFlag.zones;
    sess.loadLibrary("resourceZones"); // load Geofences Library 
	sess.updateDataFlags( // load items to current session
	    [{type: "type", data: "avl_resource", flags: flags, mode: 0}], // Items specification
		function (code){ // updateDataFlags callback
			if(code) {msg("Error: "+wialon.core.Errors.getErrorText(code)); return; } // exit if error code 

            var res = sess.getItems("avl_resource"); // get loaded 'avl_resource's items
	        for (var i = 0; i< res.length; i++) // construct Select list using found resources
	            $("#res").append("<option value='"+ res[i].getId() +"'>"+ res[i].getName() +"</option>");
	       
            getZones( $("#res").val() ); // update geozones list
	       
            // bind actions to select change	       
	        $("#res").change( function(){ getZones(this.value); } );
	        $("#zones").change( function(){ 
		        if($("#res").val()){ // if resource selected
			        // get resource by selected id
			        var res = wialon.core.Session.getInstance().getItem( $("#res").val() );
			        // get resource Zones, use 'showParams()' function as callback
			        res.getZonesData( [$("#zones").val()], showParams);
		        }
	    });
    }); 
}

function getZones( res_id ){ // get geofences by resource id
	$("#zones").html("<option></option>"); // add first empty element
	if(res_id){ // if resource id exists 
		var res = wialon.core.Session.getInstance().getItem(res_id); // get resource by id
		var zones = res.getZones(); // get resource Zones 
		for (var i in zones) // construct Select list using found resources
		    $("#zones").append("<option value='"+ zones[i].id +"'>"+ zones[i].n +"</option>");
	}
}

function showParams(code, data){ // print Geofence parameters
	if(code){ msg("Error: "+wialon.core.Errors.getErrorText(code)); return; } // exit if error code
	if(!data || !data.length){ msg("Geofence not found"); return; } // exit if no data
	var zone = data[0]; // if several zones - use first
    // get color, convert zone.c to hex and substr first 2 digits (opacity)
	var color = wialon.util.String.sprintf("%08x", zone.c).substr(2);
	msg("<b>JSON Geofence data </b> " + wialon.util.Json.stringify(zone) + "<br/>"); // print Json data
	// print color information
	msg("<b>Color</b> #" + color + " <div style='display:inline-block;width:15px;height:15px;background:#"+ color +"'></div>");  
	// print type information 
	msg("<b>Type</b> "+ (zone.t==1?"polyline":(zone.t==2?"polygon": (zone.t==3?"circle":"unknown") ) ) );
    // print radius/thickness information
	msg("<b>"+(zone.t==3?"Circle radius":"Line thickness")+"</b> "+ zone.w);
	// print name/id information
	msg(" <b>Name</b> "+ zone.n + "<b> Id</b> "+ zone.id);
}

// execute when DOM ready
$(document).ready(function () {
    wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
    // For more info about how to generate token check
    // http://sdk.wialon.com/playground/demo/app_auth_token
	wialon.core.Session.getInstance().loginToken("<?php echo $_GET['access_token'];?>", "", // try to login
	    function (code) { // login callback
	    	if (code){ msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
	    	msg("Logged successfully"); init(); // when login suceed then run init() function
	});
});

</script>
</body>
</html>