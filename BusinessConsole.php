<?php session_start();
if(!isset($_SESSION["uid"])||($_SESSION["type"])!='business')	
	die(header("Location:index.php"));
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Business Console</title>
<link rel="stylesheet" href="style.css" >
<style>
#workdetailsDiv{
		display:none;
		position:fixed;
		left:40%;
		top:25%;
		background-color:#666;
		border:2px solid black;
		width:20%;
		height:50%;
		margin:auto
	}
</style>
</head>
<body onload="fillstates();">
<div id="top"></div>
	<div class="dark"></div>
	<div class="loading"></div>
<a onclick="changeLoc('top');"><img src="Images/top.png" class="top" width="50px" height="50px" style="position:fixed;bottom:20px;right:20px;z-index:20;display:none;"/></a>    
	<?php include_once("ad.html") ?>
	<?php include_once("header.html") ?>
   
    <?php 
if(!isset($_SESSION["uid"]))
include_once("loginheader.php");
else 
{
	include_once("logoutheader.php");
}

?>
<!--	<div class="searchwork">
    <img src="cross.png" width="25" height="25" style="position:absolute;right:0%;cursor:pointer;" onclick="closereqmaster();" />
    	<table border="1px solid black" id="reqtable">
        </table>
    </div>
 -->
 	<div class="formDiv" id="editprofileDiv">
		<div class="formheadingDiv">
    		<label>Personal details</label><div class="closeDiv" onclick="closeDiv(editprofileDiv)"></div>
	    </div>
        
		<form name="businessprofileform" action="BusinessProfileSubmit.php" method="post" enctype="multipart/form-data">
	    <div class="formfieldDiv">
   		
            	<label class="label">User Id:</label><span id="uidemptyspan"></span>
                
            	<input type="text" class="textbox readonly" name="uidText" id="uidText" readonly="readonly" value="<?php echo $_SESSION['uid'] ?>"/> 
                        
        	
            	<label class="label">Full Name*:</label> <span id="nameemptyspan"></span><br /><input type="text" class="textbox" id="nameText" onblur="checknameEmpty(this.value.length);" onKeyUp="nameValid(this.value);" name="nameText"/> 
         	
            
            	<label class="label">Mobile Number*:</label> <span id="mobileemptyspan"></span><br /><input type="text" class="textbox" id="mobileText" name="mobileText" onblur="checkmobileEmpty(this.value.length);" onKeyUp="mobileValid(this.value);" />
                 
            
            	<label class="label">Email:</label>  <span id="emailemptyspan"></span><br /><input type="text" class="textbox" id="emailText" name="emailText" onkeyup="emailValid(this.value);" />
            
            
            
            	<label class="label">Residential Address:</label><br /><textarea class="textarea" id="resdaddr" rows="4" cols="20" name="resdaddr">
                						</textarea>
                 
            
             	<br />
            	<label class="label">Work Address:</label><br /><textarea class="textarea" id="shopaddr" rows="4" cols="20" name="shopaddr">
                						</textarea>
                 
            
             	<br />
            	<label class="label">State*:</label> <span id="stateemptyspan_business"></span><br /><select id="stateText" name="stateText" class="combo" onchange="fillcities(this.value);" onblur="checkstateEmptybusiness(this.value);">
                				<option value="">Select</option>
                			</select>
                 
            
            	
             	<br />
            	<label class="label">City*:</label> <select id="cityText" class="combo" name="cityText"><option value="">Select</option></select>
                 
            
            	<br />
            	<label class="label">Pin*:</label> <span id="pinemptyspan_business"></span><input type="text" class="textbox" id="pinText" name="pinText" onblur="checkpinEmptybusiness(this.value.length);" placeholder="Enter 6 digit PIN/ZIP code" onKeyUp="pinValidbusiness(this.value);" maxlength="6"/>
                 
            
             
            	<label class="label">Id Proof:</label> <input type="file" class="file" id="idpic" name="idpic" onchange="previewidPic(this);"/>
                <div class="previewimageDiv"></div> 
            
            	<br /> 
             	<label class="label">Occupation:</label> <input type="text" class="textbox" name="occText" id="occText" value=""/>
             
                        
            	 <input type="submit" class="button" name="submit" id="submitUpdate" value="Update"/>                        
        
		</div>
	</form>
    </div>
 	
    
    <div class="alert" id="updateAlert">
 	<p>Your details have been succesfully updated</p>
 	</div>
    
    
	<div class="centerDiv"> 
    	       
        <div class="circlesDiv">
        	<div class="circles_subDiv" onclick="showeditprofilePopup();">
                	<div class="circles_subImgDiv" id="editprofileImgDiv"></div>
                    <div class="circles_subLabelDiv"><label>Edit Profile</label></div>
            </div>
            <a onclick="changeLoc('referredworkerDiv');"><div class="circles_subDiv" onclick="seereferredworkersDiv();">
                	<div class="circles_subImgDiv" id="seereferredImgDiv"></div>
                    <div class="circles_subLabelDiv"><label>See Referred Workers</label></div>
            </div></a>
        </div>
        
        <div class="tableDiv" id="referredworkerDiv" style="display:none;">
    	<div class="headingtableDiv"  >
	    	<label>Referred workers</label><div class="closeDiv" onclick="closeDiv(referredworkerDiv)"></div>
        </div>
        	<table id="referredworkertable" class="table">
            </table>
    	</div>
    
       <div id="detailsDiv" class="detailsDiv">
            <img src="Images/cross.png" width="25" height="25" style="position:absolute;top:0;right:0%;cursor:pointer;" onclick="closeDetails();" />
            Name: <span id="nameSpan" class="textbox"></span><br /></br>
            Mobile: <span id="mobileSpan" class="textbox"></span><br /></br>
            Residential Address<br /><textarea id="readaddr" class="textarea" cols="20" rows="5" disabled="disabled"></textarea><br /><br />
            SMS:<br /><textarea id="smstextarea" cols="20" class="textarea" rows="5">Service required:</textarea><br />
            <input type="button" class="tablebutton"  name="smssend" value="Send SMS" onclick="sendSMS();" />
        </div>

    <?php include_once("footer.html") ?>   
    </div>    
	
<script src="jquery-1.8.2.min.js"></script>
<script src="processing.js"></script>

<script>	
	
	 
	//************************************************************EDIT PROFILE****************************************************************************
    function showeditprofilePopup()
	{
		$('#editprofileDiv').fadeIn('slow');
		fillDataprofile($('#uidText').val());
	}
	
	var nameval=mobileval=stateval=pinval=1;
	var emailval=1;
	var global;
	function fillDataprofile(uid)
	{	
		   var url = "searchbusinessfill.php?uid="+uid;
		   $.get(url,function(data,success)
		   	{
				var ary=data.split(";");
				if(ary.length==1)
				alert("Invalid id");
				else
				{
					$("#nameText").val(ary[0]);
					$("#mobileText").val(ary[1]);
					$("#resdaddr").val(ary[2]);
					$("#emailText").val(ary[3]);							  
					$("#stateText").val(ary[5]);
					fillcities($("#stateText").val());
					global = ary[4];					
					$("#pinText").val(ary[6]);
					$('#occText').val(ary[7]);
					$('#shopaddr').val(ary[8]);
					$(".previewimageDiv").css("background-image","url(businessIds/"+ary[9]+")");											  
				   // $("#idpic").val(ary[13]);
				   //$("#profilepic").val(ary[12]);							  
													
			    }
			  
			});			   
	  	   
    }
	
	
	
	/*$('#uidText').on('keyup',function (e){       
			 if($('#uidText').val()!="")
			{
			var url = "checkuid.php";
			//alert(url);
   			$.ajax({
   				type:'GET',
   				url :url,
				data: {uid: $('#uidText').val(), type:'business'} ,
				global:false,
  				success: function(data) {
 			   			
			   			if(data==0)
							{
								$("#uidemptyspan").html(" *not found").css("color","red");
								uidval=0;
							}
						else {
								$("#uidemptyspan").html(" found").css("color","green");
								uidval=1;
							}
			   
					},
  			 error:function(jqXHR,textStatus,errorThrown){alert('Exeption:'+errorThrown);}
			 
				}); 
				
			}
			else
			{
				$("#uidemptyspan").html("");
			}
 	
	});

	
	*/
	
	//*******validating user id*********//DONE
     
	function checknameEmpty(length)
   {
	   if(length==0)
	   		{
				$("#nameemptyspan").html("  *This is required").css("color","red");
				$("#nameText").css("background-image","none");
				nameval=0;
			}
		else
			{
				$("#nameemptyspan").html("");
			}
			
   }

	function nameValid(rec)
	{
	//alert(rec);
	if(rec!="")
		{
			var reg = /^([a-zA-Z]{1}[a-zA-Z'\s]{0,69})$/;
			//alert(reg.test(rec));
			if(reg.test(rec))
			{
				//$("#UseridTextGood").html("Valid").css("color","green");
				//$("#nameemptyspan").html("Okay").css("color","green");
				$("#nameText").css("background-image","url(Images/tick.png)");
				nameval=1;
				
			}
			else
			{
				//$("#nameemptyspan").html("not a valid name").css("color","red");
				$("#nameText").css("background-image","url(Images/wrong.png)");
				nameval=0;
			}
			
		}
		else 
		{
			$("#nameText").css("background-image","none");
			nameval=0;
		}
			
	}
	
	//*******validating mobile*********//Done
   
   function checkmobileEmpty(length)
   {
	   if(length==0)
	   		{
				$("#mobileemptyspan").html("  *This is required").css("color","red");
				//$("#nameText").css("background-image","url(Images/tick.png)");
				$("#mobileText").css("background-image","none");
				mobileval=0;
			}
		else
			{
				$("#mobileemptyspan").html("");
			}
			
   }

	function mobileValid(rec)
	{
	//alert(rec);
	if(rec!="")
		{
			var reg = /^[7-9]{1}[0-9]{9}$/;
			//alert(reg.test(rec));
			if(reg.test(rec))
			{
				//$("#UseridTextGood").html("Valid").css("color","green");
				//$("#mobileemptyspan").html("Okay").css("color","green");
				$("#mobileText").css("background-image","url(Images/tick.png)");
				mobileval=1;
				
			}
			else
			{
				//$("#mobileemptyspan").html("not a valid phone no.").css("color","red");
				$("#mobileText").css("background-image","url(Images/wrong.png)");
				mobileval=0;
			}
			
		}
		else 
		{
			$("#mobileText").css("background-image","none");
			mobileval=0;
		}
			
	}
	
	//*******validating email*********//

	function emailValid(rec)
	{
	//alert(rec);
	if(rec!="")
		{
			var reg = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
			//alert(reg.test(rec));
			if(reg.test(rec))
			{
				
				//$("#emailemptyspan").html("Okay").css("color","green");
				$("#emailText").css("background-image","url(Images/tick.png)");
				emailval=1;
				
			}
			else
			{
				//$("#emailemptyspan").html("not a valid email").css("color","red");
				$("#emailText").css("background-image","url(Images/wrong.png)");
				emailval=0;
			}
			
		}
		else 
		{
			$("#emailemptyspan").html("");
			$("#emailText").css("background-image","none");
			emailval=1;
		}
			
	}
	
	function checkstateEmptybusiness(val)
   {
	   if(val=='select')
	   		{
				$("#stateemptyspan_business").html("  *This is required").css("color","red");
				stateval=0;
			}
		else
			{
				$("#stateemptyspan_business").html("");
				stateval=1;
			}
			
   }
   
   //********validating pincode******************
   function checkpinEmptybusiness(length)
   {
	   if(length==0)
	   		{
				$("#pinemptyspan_business").html(" *This is required").css("color","red");
				$("#pinText").css("background-image","none");
				pinval=0;
			}	
		else
			$("#pinemptyspan_business").html("");	
   }

	function pinValidbusiness(rec)
	{
	//alert(rec);
	  if(rec!="")
		  {
			  var reg = /^[0-9]{6}$/;
			  //alert(reg.test(rec));
			  if(reg.test(rec))
			  {
				  //$("#UseridTextGood").html("Valid").css("color","green");
				  //$("#mobileemptyspan_signup").html("Okay").css("color","green");
				  $("#pinText").css("background-image","url(Images/tick.png)");
				  pinval=1;
				  
			  }
			  else
			  {
				  //$("#mobileemptyspan_signup").html("not a valid phone no.").css("color","red");
				  $("#pinText").css("background-image","url(Images/wrong.png)");
				  pinval=0;
			  }
			  
		  }
		  else 
		  {
			  //$("#mobileemptyspan_signup").html("");
			  $("#pinText").css("background-image","none");
			  pinval=0;
		  }
			
	}
	
	//******all validations check on submit*********
   document.getElementById('submitUpdate').addEventListener('click',function(e){
	   
	   
	   if(mobileval===0||nameval==0||emailval==0||stateval==0||pinval==0)
	   {
	 	 	e.preventDefault();
	   }
	   else
	   {
		   $('#updateAlert').fadeIn("fast");
	   }
	   });
	   
	   
	   function fillstates()
		{
						
		   var url = "fillcombos.php?type=states";
		   $.get(url,function(data,success){
			   
			   		   var ary=data.split(";");
						if(ary.length==1)
						  alert("error"+data);
						  else
						  {
							 //alert(data);										
							 for(var i=0; i<ary.length-1;i++)							 
							 {
								 $("#stateText").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 }
						  }
			  
			   });
		}
		
		 
	   function fillcities(state)
		{
			
			if(state!="select")
			{
				 var url = "fillcombos.php?type=cities&state="+state;			  
		  		 $.get(url,function(data,success)
				{
			   
			   		   var ary=data.split(";");
						if(ary.length==1)
						  alert("error"+data);
						  else
						  {		
						  		$("#cityText").empty();								
							 for(var i=0; i<ary.length-1;i++)							 
							 {
								 $("#cityText").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 }
							 $("#cityText").val(global);
						  }
			  
			   });
			}
			else{
				$("#cityText").empty();
				$("#cityText").append("<option value='select'>Select</option>");
				//$("#cityText").prop("autofocus","autofocus");
			}
		}
		
		
	 function previewidPic(file)
	{
		if(file.files&&file.files[0])
		{
			var reader = new FileReader();
			reader.onload=function(e){
				
				$(".previewimageDiv").css("background-image","url("+e.target.result+")");
				
				}	
				reader.readAsDataURL(file.files[0]);
		}
	}

/*	$(".closeDiv").on('click',function(){
			
		$(".formDiv").css("display","none");
		
	});
	*/ 
	 
	 
	//***********************************************************REFERRED WORKER*******************************************************************
	function seereferredworkersDiv()
	{
		$('#referredworkerDiv').slideDown('slow');
		fetchReferredWorkers();
	}
	function fetchReferredWorkers()
	{
		var businessId= "<?php echo $_SESSION["uid"] ?>";
//		alert(businessId);
		$.ajax({
				  type:"GET",
				  dataType:"JSON",
				  url:"fetchreferredworkers.php?businessId="+businessId,
				  contentType:"application/json;charset=utf-8",
				  success:function(data)
						{
							
							
							$("#referredworkertable").empty();
							$("#referredworkertable").append("<tr><th>Name</th><th>type</th><th>Mobile</th><th>details</th></tr>");
							//alert(data.length);
							for(i=0;i<data.length;i++)
								{

								  var row=$('<tr>');
								  row.append("<td>"+data[i].name+"</td>");
								  row.append("<td>"+data[i].fieldofwork+"</td>");
								  row.append("<td>"+data[i].mobile+"</td>");									  
								  row.append("<td><center><img src='Images/details.jpeg' id='"+data[i].uid+"' width=100 height=50 onClick='doDetails(id);'></center></td>");
								  $("#referredworkertable").append(row);
								}
						}
				});
	}
	
	
	var mob;
	function doDetails(uid)
		{
			//alert(rid);
			$('#detailsDiv').slideDown('slow');	
			$.ajax(
					{
   						type:'GET',
		   				url :'getworkerdetails.php?uid='+uid,
						dataType:"JSON",
						contentType:"application/json;charset=utf-8",
  						success: function(data)
							{
								//alert(data.length);
								//alert(JSON_stringify(data));
								$("#nameSpan").html(data[0].name);
								$("#mobileSpan").html(data[0].mobile);
								mob=data[0].mobile;
								$("#readaddr").val(data[0].resdaddr);
								$("#smstextarea").val("");
								
							}
  			 			//error:function(jqXHR,textStatus,errorThrown){alert('Exeption:'+errorThrown);}
			 
						});
			
		}
   		
		function sendSMS()
		{
			
			msg = $('#smstextarea').val();
			var url = "SMSsender.php?mob="+mob+"&msg="+msg;
			$.get(url,function(data,success){
				
				if(data==1)
				alert("SMS sent");
				else if(data==0)
				{}
				else
				alert(success+" "+data);
				
				});
		}
		
		function closeDetails()
		{
			$('#detailsDiv').fadeOut();
		}
		
		//***********************************************************COMMON*********************************************************************************	
	 
	
	function closeDiv(id)
	 {
		 $(id).slideUp('slow');
	 }
	
	function changeLoc(id)
			{
				
				//$("html, body").animate({scrollTop:$("#"+id).offset().top},"slow");
				  $('html, body').animate({scrollTop:$('#'+id).offset().top-25},'slow');
			}
</script>


</body>
</html>
