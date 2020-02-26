<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
Select unit:
<div id="units">
</div>
<div id="log"></div>
<script type="text/javascript">
function msg(text) { $("#log").prepend(text + "<br/>"); }
function init() {
	var sess = wialon.core.Session.getInstance();
	var flags = wialon.util.Number.or(wialon.item.Item.dataFlag.base, 8388608);
	sess.loadLibrary("itemProfileFields");
	sess.updateDataFlags( 
		[{type: "type", data: "avl_unit", flags: flags, mode: 0}],
		function (code) {
			if(code){ 
				msg(wialon.core.Errors.getErrorText(code)); 
			   $('.log').css('background-color', 'red'); 
			   return; 
			}
			var units = sess.getItems("avl_unit");
			if (!units || !units.length){ msg("No units found");
			 $('.log').css('background-color', 'red');
			 return; 
			}
			for (var i = 0; i< units.length; i++){ 
				var u = units[i]; 
				$("#units").append("<li value='"+ u.getId() + "' class='ui-btn ui-btn-icon-right ui-icon-check ui-li-static ui-body-inherit'>"+ u.getName()+ "</li>");
			}
			$("#units li").click(selectedUnit);
		}
	);
}
function selectedUnit(event){  
	var sess = wialon.core.Session.getInstance();
	var unit = sess.getItem($(this).val());
	var servs = unit.getProfileFields();
	console.log(servs);
	console.log(unit); 
	for(var i in servs){
		document.write(servs[ i ].n);
	}
}
$(document).ready(function(){
    wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com"); 
	wialon.core.Session.getInstance().loginToken("df55b9c1f05f51d44224c6b85cb2bc90765145D12A6C708DC76C375D5EA24FFD2DA6D672", "", 
	function (code) {
		if (code){ msg(wialon.core.Errors.getErrorText(code)); return; } 
        init();
	});
});
</script>