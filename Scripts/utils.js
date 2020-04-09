
function notification(message, status = 'normal'){
    /*
        primary	UIkit.notification("Primary message...", {status:'primary'})
        success	UIkit.notification("Success message...", {status:'success'})
        warning	UIkit.notification("Warning message...", {status:'warning'})
        danger	UIkit.notification("Danger message...", {status:'danger'})
    */
    UIkit.notification({
        message: message,
        status: status,
        pos: 'top-center',
        timeout: 3000
    });
}


//------------------------------------------------------------------------------
//function disableselect(e){ 
//	return false 
//} 
//function reEnable(){ 
//	return true 
//} 
//document.onselectstart=new Function ("return false");
//	if (window.sidebar){ 
//		document.onmousedown=disableselect 
//		document.onclick=reEnable 
//	} 
////Inhabilitar boton derecho
//function right(e) { 
//	if (navigator.appName == 'Netscape' && (e.which == 3 || e.which == 2)){ 
//		alert("Coloca el mensaje aquí."); 
//		return false; 
//	} 
//	else if (navigator.appName == 'Microsoft Internet Explorer' && 
//	(event.button == 2 || event.button == 3)) { 
//		alert("Coloca el mensaje aquí"); 
//		return false; 
//	} 
//	return true; 
//} 
//document.onmousedown=right;  


//------------------------------------------------------------------------------
		