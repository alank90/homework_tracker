//====  AJAX used to post updated Description info field ======== //

var el = document.getElementById("list");
var str = "";
var id_val;

//Get updated Desription field value when click outside of UL field.
el.addEventListener("blur", function(e) {
	str = e.target.innerHTML;
	id_val = e.target.getAttribute("data-id");
	//Need to encode string in case special characters like &amp used.
	str =  encodeURIComponent(str);
	console.log(e.target);
	console.log(str);

	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	/* Monitoring of State of the AJAX request and assigning response
	 from server to a variable on success */
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("post_message").innerHTML = this.responseText;
		}
	}
	// Setup and sending of the AJAX request
	var parameters = "desc_value=" + str + "&id=" + id_val;
	xmlhttp.open("POST", "update.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(parameters);
	//  }
}, true);
// Need Event capturing here because blur does not bubble.