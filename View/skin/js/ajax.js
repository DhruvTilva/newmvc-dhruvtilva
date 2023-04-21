 var ajax={
 	"method" : "post",
 	"data" : [],
 	"url" : "http://localhost/Project/newmvc-dhruvtilva/Index.php?c=ajax&a=response",
 	'call' : function (){

 		var action = $("#ajaxForm").attr('action');
 		console.log(action);

 		$.ajax({
 			method: "POST",
 			url: action,
 			data:{ name: "dhruv", location: "ahmedabad"}
 		})

 		.done(function(msg){
 			console.log("data saved:"+ msg);
 		});
 	}

 }; 

 ajax.call();

