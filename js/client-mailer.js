function sendMail(message, name, email, doneFn)
{
	if(!name) name = "User";
	if(!email) email = "no-reply@blogger.com";
	
	if(message)
	{
		console.log(doneFn);
		$(document).ready(function(){
			$.post( "https://www.blogger.com/contact-form.do", { 
				name: name
				, email: email 
				, message: message 
				, blogID: "6958217075977861066"
			});
			if(typeof(doneFn)=="function")
				doneFn();
		});
	}
}

