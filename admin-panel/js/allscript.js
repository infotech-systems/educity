

 //------------------ajax code--------
function Inint_AJAX() {
   try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
   try { return new XMLHttpRequest(); } catch(e) {} //Native Javascript
   alert("XMLHttpRequest not supported");
   return null;
};

function my_dochange(src, val) {
	 
	 var req = Inint_AJAX();                   
     var s=src;
     req.onreadystatechange = function () {
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(s).innerHTML=req.responseText;
               }
          }
     };
     req.open("GET", "./back/pin_back.php?data="+src+"&val="+val);
  //  alert(src);
   // alert(val);
    //alert(hd_value);
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1");
     req.send(null);
    // alert(req.responseText);
	
}

function sender_change(src, val) {
//	alert(cont_id);
	 var req = Inint_AJAX();                   
     var s=src;
     req.onreadystatechange = function () {
          if (req.readyState==4) {
               if (req.status==200) {
                    document.getElementById(s).innerHTML=req.responseText;
					//alert(req.responseText);
               }
          }
     };
     req.open("GET", "./tables.php?data="+src+"&val="+val);
  //  alert(src);
  //  alert(val);
    //alert(sg_val);
	//alert(rd_val);
     req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=iso-8859-1");
     req.send(null);
    // alert(req.responseText);
	
}


