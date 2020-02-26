<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="//hst-api.wialon.com/wsdk/script/wialon.js"></script>
<script>
var sess = null;
function init1() { 
	sess = wialon.core.Session.getInstance();
	var flags = wialon.item.Item.dataFlag.base;
	sess.updateDataFlags( 
	[{type: "type", data: "avl_unit", flags: flags, mode: 0}], 
		function (code) { 
			if (code) { 
				return; 
			} 
			var units = sess.getItems("avl_unit");
		} 
	);
	sess.loadLibrary("itemCustomFields");
	var flags = wialon.util.Number.or(wialon.item.Item.dataFlag.base, wialon.item.Item.dataFlag.customFields, wialon.item.Item.dataFlag.adminFields);
	sess.updateDataFlags( 
	[{type: "type", data: "avl_unit", flags: flags, mode: 0}], 
		function (code) {
			if (code) { return; }
			// var unit = sess.getItem(<?php echo $_POST['unitvalue'];?>);
			var unit = sess.getItem(13459293);
			var pr  = unit.getCustomFields();
			console.log(pr);
			// console.log(pr[2].v);
		}
	);
}
wialon.core.Session.getInstance().initSession("https://hst-api.wialon.com");
wialon.core.Session.getInstance().loginToken("df55b9c1f05f51d44224c6b85cb2bc90768621593482D0F6F68AD8151C8D6AD31C24FBAA", "",
	function (code) { 
		if (code){ return; }
		init1();
});
</script>