"use strict";
var KTDatatablesBasicPaginations = function() {

	var initTable1 = function() {
		var table = $('#manager');
		table.DataTable({
			
		});
		var table2 = $('#manager2');
		if(table2)table2.DataTable({
			
		});
		var table3 = $('#manager3');
		if(table3)table3.DataTable({
			
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};
}();


jQuery(document).ready(function() {
	KTDatatablesBasicPaginations.init();
});