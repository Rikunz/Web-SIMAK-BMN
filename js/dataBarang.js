let timenow = new Date();
var minutes = timenow.getMinutes();
if (minutes < 10){
    minutes = "0" + minutes;
}
document.getElementById("lastupdate").innerHTML = "Last update:" + timenow.getDate() + "/" + timenow.getMonth() + "/" + timenow.getFullYear() + ". " + timenow.getHours() + ":" + minutes;
