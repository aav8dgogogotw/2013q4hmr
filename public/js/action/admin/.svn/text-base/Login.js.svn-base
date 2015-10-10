//登入列表使用
$(document).ready(function()
{
	$('#LoginForm').validate({
		rules:{
			userName : {required:true},
			passWord : 
			{
				required:true,
				minlength: 4
			}
		},
		messages: {
			userName: "請輸入帳號",
			passWord:{
				required:"請輸入密碼",
				minlength: "請輸入長度大於3的密碼"
			}
		},
		invalidHandler: function(f, validator) 
		{
            var errors = validator.numberOfInvalids();
            if (errors) 
			{
				var errors = "";
				if (validator.errorList.length > 0) 
				{
					for (x=0;x<validator.errorList.length;x++) 
					{
						errors += "\n\u25CF " + validator.errorList[x].message;
					}
				}
				alert(errors);
			}
		},
		showErrors: function(errorMap, errorList){}     		
	});

});
function submithandle()
{
	if($("#LoginForm").valid() == true)
	{
		$("#LoginForm").submit();
	}
}

