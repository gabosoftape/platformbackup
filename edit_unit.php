<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Wialon Playground - Unit edit fields</title>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
</head>
<body>
<style>
#log, td{ border: 1px solid #c6c6c6; padding:5px;}
table select, table input { width:100%; }
</style>


<p>
	Select unit:
		<select id="units">
				<option>Select unit...</option>
		</select>
	Select property:
		<select id="props">
				<option>Select property...</option>
		</select>
</p>
	<table id="table">
		<tr>
			<td >ID</td>
			<td>Name</td>
			<td>Value</td>
		</tr>
		<tr>
			<td><input type="text" id="prop_id"  placeholder="prop_id" disabled="disabled"/></td>
			<td><input type="text" id="prop_name" placeholder="prop_name"/></td>
			<td><input type="text" id="prop_value" placeholder="prop_value"/></td>
		</tr>
	</table>
	<p>
		<input type="button" value="Create" id="create_btn"/>

		<input type="button" value="Update" id="update_btn"/>

		<input type="button" value="Delete" id="delete_btn"/>
	</p>

<div id="log"></div>


<script type="text/javascript">
var cur_unit = null; // global variable
var cur_prop = null; // global variable
var sess = null;

// Print message to log
function msg(text) { $("#log").prepend(text + "<br/>"); }

function init() { // Execute after login succeed
  	$unitsSelect = $("#units");
	sess = wialon.core.Session.getInstance(); // get instance of current Session
  
  
	// flags to specify what kind of data should be returned
	var flags = wialon.item.Item.dataFlag.base;

    sess.updateDataFlags( // load items to current session
	[{type: "type", data: "avl_unit", flags: flags, mode: 0}], // Items specification
		function (code) { // updateDataFlags callback
    		if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code

            // get loaded 'avl_unit's items  
	    	var units = sess.getItems("avl_unit");
    		if (!units || !units.length){ msg("Units not found"); return; } // check if units found

		    for (var i = 0; i< units.length; i++){ // construct Select object using found units
			    var u = units[i]; // current item in cycle
              
                // append option to select
			    $unitsSelect.append("<option value='"+ u.getId() +"'>"+ u.getName()+ "</option>");
			}

            // bind action to select change event
          $unitsSelect.change( getProperties  );
	    }
	);
}

function getProperties(){ // construct properties Select list for selected item

	if(!$("#units").val()){ msg("Properties item"); return;} // exit if no item selected
	
  	clearForm(); // clear fields
  	var id = parseInt( $("#units").val() );
  
  	// IMPORTANT! for loading custom fields needed loaded library "itemCustomFields"
  
	sess.loadLibrary("itemCustomFields");

    // flags to specify what kind of data should be returned
	
    var flags = wialon.util.Number.or(wialon.item.Item.dataFlag.base, wialon.item.Item.dataFlag.customFields, wialon.item.Item.dataFlag.adminFields);
  	
    sess.updateDataFlags( // load items to current session
	[{type: "type", data: "avl_unit", flags: flags, mode: 0}], // Items specification
		function (code) { // updateDataFlags callback
          
            if (code) { msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code

            // get loaded 'avl_unit's item by ID  
	    	var unit = sess.getItem( id );
          
			var pr  = unit.getCustomFields();
          
			// save to global variable
            cur_unit = unit;
            cur_prop = pr;

			// reset select
			$("#props").html('<option>Select property...</option>')
            
          	for (var i in pr ) {  // construct select list


            	$("#props").append("<option value='" + pr[i].id + "'>" + pr[i].n + "</option>");
				msg( 'load property: ' +  pr[i].n)
            }
				msg('');
          	
          	// bind action to select change event
          	$("#props").change( renderProp );
        
	    }
	);
}

function clearForm(){ // clear fields function
	cur_prop = null;
	$("#prop_id").val("");
	$("#prop_name").val("");
	$("#prop_value").val("");
	$('#props').prop('selectedIndex',0);
}
  
function renderProp(){ // get and show information about selected property
	var prop_id = $("#props").val();

	if( !prop_id ){ msg("Select item"); return; } // exit if no item selected
	if( !$("#props").val() ){ clearForm(); return; } // clear fields if empty element selected

	// put property information to corresponding fields
	$("#prop_id").val( prop_id );
	$("#prop_name").val( cur_prop[prop_id].n );
	$("#prop_value").val( cur_prop[prop_id].v );
}

function createProperty(){ // create property for selected unit using entered data
    // get property information from corresponding fields
  
  
    var prop_id =  $("#prop_id").val(),
    	name = $("#prop_name").val(),
    	value = $("#prop_value").val();
  
  	// validate ID
  	if (prop_id in cur_prop) {
      	msg('You can not create a property with an existing ID!');
        return;
  	}

	// check empty field    	
    if  ( !name.length || !value.length || !cur_unit) {
    	msg('Please fill in all fields.')
    	return;
    }
  
    // add property
  	cur_unit.createCustomField( {id: prop_id, n: name, v: value} );

  	msg( 'Property add: name=' + name + ', value=' +  value );

  	// update DOM
  	$('#units').change();
  	getProperties();
}

function updateProperties(){ // update selected property using entered data
    // get property information from corresponding fields
  
  
    var prop_id =  $("#prop_id").val(),
    	name = $("#prop_name").val(),
    	value = $("#prop_value").val();

	// check exist editionly field  
    if  ( !(prop_id in cur_prop) || !name.length || !value.length || !cur_unit) {
    	msg('Please fill in all fields.')
    	return;
    }

	// check empty field    	
    if  ( !name.length || !value.length || !cur_unit) {
    	msg('Please fill in all fields.')
    	return;
    }
    // update property
  	cur_unit.updateCustomField( {id: prop_id, n: name, v: value} );

  	msg( 'Property update: name=' + name + ', value=' +  value );

  	// update DOM
  	getProperties();
}

function deleteProperty(){ // delete selected property
    // get property information from corresponding fields    
    var prop_id =  $("#prop_id").val();

    if  ( !prop_id ) return;

    if ( !(prop_id in cur_prop) ) {
    	msg('Property id not found in unit');
    	return;
    }

    // confirm user for delete property;
    var answer = confirm('Do you really want to delete property "' + $("#prop_name").val() + '"?')

    if (!answer) return;
  
    // delete property
  	cur_unit.deleteCustomField( prop_id );
  	
   	//delete cur_unit[name];

  	msg( 'Property delete: id=' + prop_id );
  	
  	// update DOM
  	clearForm();
  	$('#units').change();
  	getProperties();
}

// execute when DOM ready
$(document).ready(function () {
    // bind actions to button clicks
	$("#create_btn").click( createProperty );
	$("#update_btn").click( updateProperties );
	$("#delete_btn").click( deleteProperty );
  
    wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); // init session
    // For more info about how to generate token check
    // http://sdk.wialon.com/playground/demo/app_auth_token
	wialon.core.Session.getInstance().loginToken("<?php echo $_GET['access_token'];?>", "", // try to login
	    function (code) { // login callback
    		if (code){ msg(wialon.core.Errors.getErrorText(code)); return; } // exit if error code
	    	msg("Logged successfully");
        init(); // when login suceed then run init() function
	});
});

</script>
</body>
</html>