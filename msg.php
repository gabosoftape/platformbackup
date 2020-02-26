<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Wialon Playground - Get messages</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
</head>
<body>
<style>
#log{border: 1px solid #c6c6c6;}
.wrap{max-height:100px; overflow:auto;}
td{white-space: nowrap;}
.odd{background:#EEE;}
</style>


Select unit: <select id="units"><option></option></select>
<input type="button" value="Load messages for last 24 hours" id="load_btn"/><br/>
Show messages from <input type="text" id="show_from" value="0"/>
to <input type="text" id="show_to" value="100"/>
<input type="button" value="Show messages" id="show_btn"/>
<div class="wrap" style="min-height: 450px;"><table id="messages"></table></div>
<div id="log"></div>


<script type="text/javascript">
// Print message to log
function msg(text) { $("#log").prepend(text + "<br/>"); }

function init() { // Execute after login succeed
	// flags to specify what kind of data should be returned
	var flags = wialon.item.Item.dataFlag.base;
	wialon.core.Session.getInstance().updateDataFlags( // load items to current session
		[{type: "type", data: "avl_unit", flags: flags,mode: 0}], // Items specification
		function (code) {  // updateDataFlags callback
			if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
			initData(); // execute if items load succeed
	});
}

function initData() { // Execute after items load to Session
	var sess = wialon.core.Session.getInstance(); // get instance of current Session
	var units = sess.getItems("avl_unit"); // get loaded 'avl_unit's items  
	if (!units || !units.length){ msg("Units not found"); return; } // check if units found
        
	for (var i=0; i<units.length; i++) // construct Select object using found units
		// append option with current unit to select
		$("#units").append("<option value='" + units[i].getId() + "'>" + units[i].getName() + "</option>");
}

function loadMessages(){ // load messages function
	var sess = wialon.core.Session.getInstance(); // get instance of current Session	
	var to = sess.getServerTime(); // get ServerTime, it will be end time
	var from = to - 3600*24; // get begin time ( end time - 24 hours in seconds )
	
	var unit = $("#units").val(); // get selected unit id
	if(!unit){ msg("Select unit first"); return; } // exit if no unit selected
	var ml = sess.getMessagesLoader(); // get messages loader object for current session
	ml.loadInterval(unit, from, to, 0, 0, 100, // load messages for given time interval
	    function(code, data){ // loadInterval callback
		    if(code){ msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
    		else { msg(data.count +" messages loaded. Click 'Show messages'");} // print success message 
	    }
    );
}

function showMessages(from, to){ // print given indicies (from, to) of messages 
	$("#messages").html(""); // clear message container
	// get messages loader object for current session
	var ml = wialon.core.Session.getInstance().getMessagesLoader(); 
	ml.getMessages(from, to, //get messages data for given indicies
	    function(code, data){ // getMessages callback
		    if(code){ msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
		    else if(data.length == 0){ // exit if no messages loaded
		        msg("Nothing to show. Load messages first"); return;}
	        var from_index = from; // counter for display
	        for(var i=0; i<data.length; i++) // display result cycle
		        $("#messages").append( // append current message row to result table
			        "<tr"+ (i%2==1?" class='odd' ":"") +"><td>"+ (from_index++) +"</td>"+
			        // print Json data of current message
			        "<td>"+wialon.util.Json.stringify(data[i])+"</td></tr>"); 
	        msg(data.length + " messages shown from "+ from+" to "+ to); // Print message to log
	    }
    );
}

// execute when DOM ready
$(document).ready(function () {
    // bind actions to button clicks
	$("#load_btn").click( loadMessages );
	$("#show_btn").click( function(){ showMessages($("#show_from").val(),$("#show_to").val()); } );
  
	wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
    // For more info about how to generate token check
    // http://sdk.wialon.com/playground/demo/app_auth_token
	wialon.core.Session.getInstance().loginToken("df55b9c1f05f51d44224c6b85cb2bc9083AD0F84328C628495FE4D792A387B1AF030492D", "", // try to login
		function (code) { // login callback
		    // if error code - print error message
			if (code){ msg(wialon.core.Errors.getErrorText(code)); return; }
			init(); // when login suceed then run init() function
	});
});

</script>
</body>
</html>