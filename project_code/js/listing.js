$(document).ready(function(){ 
	$("form#facets").facets({ 
		URLParams : [ {
    				name: "ajax",
    				value: "true"
					},
					],
		preAJAX : function () { 
			//validate inputs here!
			var minPay = $("#minPay").val();
			var maxPay = $("#maxPay").val();
			if((minPay != "" && minPay != undefined && !/^\d+$/.test(minPay)) || (maxPay != "" && maxPay != undefined && !/^\d+$/.test(maxPay))) { 
				alert("Minimum and Maximum price must be numbers.");
				return false;	
			}
			else if(minPay != undefined && maxPay != undefined && /^\d+$/.test(minPay) && /^\d+$/.test(maxPay) && parseInt(minPay) > parseInt(maxPay)) {
				alert("Maximum price must be larger than minimum price.");
				return false;
			}

			
			return true;
		}
	});
});
