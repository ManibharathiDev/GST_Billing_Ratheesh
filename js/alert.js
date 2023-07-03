	var _swalclose=window.swal.close;
var _swal = window.swal;
window.swal = function(){
var previousWindowKeyDown = window.onkeydown;
_swal.apply(this, Array.prototype.slice.call(arguments, 0));
window.onkeydown = previousWindowKeyDown;
};
window.swal.close=function(){
_swalclose.apply(this);
};
function start()
			{
				swal({   
						title: "Please Wait..",   
						text: "",
						showConfirmButton: false,
						imageUrl: "images/load.gif"});
			}
			
			function end(){
				swal({   
						title: "Please Wait..",   
						text: "",
						timer:0,
						showConfirmButton: false,
						imageUrl: "images/load.gif"});
			}
