<?php session_start();
if(!isset($_SESSION["uid"])||($_SESSION["type"])!='worker')	
	die(header("Location:index.php"));
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Worker Console</title>
<link rel="stylesheet" href="style.css" >

</head>
<body onload="fillstates();fillsearchcombos();">
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
 	
	<div class="formDiv">
		<div class="formheadingDiv">
			<label>Personal details</label><div class="closeDiv" onclick="closeDiv();"></div>
		</div>
		
		<form name="workerprofileform" action="WorkerProfileSubmit.php" method="post" class="form"  enctype="multipart/form-data">
				<div class="formfieldDiv">
        	
            	<label class="label">User Id:</label>
            
            
            	<input type="text" class="textbox readonly" name="uidText" id="uidTextprofile" readonly="readonly" value="<?php echo $_SESSION['uid'] ?>"/>
            
            
            	<br />
            	<label class="label">Field of Work:</label>
            
            
            	<select class="combo" id="fieldofwork" name="fieldofwork">
                        
                	</select>	
                 <br />
            	<label class="label">Full Name*:</label> <span id="nameemptyspan"></span><br /><input type="text" class="textbox" id="nameText" onblur="checknameEmpty(this.value.length);" onKeyUp="nameValid(this.value);" name="nameText"/> 
         	
            
            	<label class="label">Mobile Number*:</label> <span id="mobileemptyspan"></span><br /><input type="text" class="textbox" id="mobileText" name="mobileText" onblur="checkmobileEmpty(this.value.length);" onKeyUp="mobileValid(this.value);" />
            
      
            
            	<label class="label">Experience>=:</label> <select class="combo" id="exp" name="exp">
                					<option value="1">1</option>
                       				<option value="2">2</option>
			                        <option value="3">3</option>
            			            <option value="4">4</option>
                                    <option value="5">5</option>
			                        <option value="10">10</option>
                				</select>
                
            
            <br />
            	<label class="label">Shop/Office Address:</label><br /><textarea class="textarea" id="ofcaddr" rows="4" cols="20" name="ofcaddr">
                						</textarea>
                 
            
            	<br /> 
            	<label class="label">Specialization:</label><br /><textarea class="textarea" id="spec" rows="4" cols="20" name="spec">
                						</textarea>
                 
            
             	<br />
            	<label class="label">Any previous works:</label><br /><textarea class="textarea" id="prevwork" rows="4" cols="20" name="prevwork">
                						</textarea>
                 
            	
        		<br />	
            	
            
            
            	<label class="label">Residential Address:</label><br /><textarea class="textarea" id="resdaddr" rows="4" cols="20" name="resdaddr">
                						</textarea>
                 
            
            
            	<br />
            	<label class="label">State*:</label> <span id="stateemptyspan_worker"></span><br /><select class="combo stateText" id="stateTextprofile" name="stateText" onchange="fillcitiesprofile(this.value);" onblur="checkstateEmptyworker(this.value);">
                				<option value="select">Select</option>
                			</select>
                 
            
            
             	<br />
            	<label class="label">City*:</label> <select class="combo" id="cityTextprofile" name="cityText"><option value="select">Select</option></select>
                 
            
            
            	<br />
            	<label class="label">Pin*:</label> <span id="pinemptyspan_worker"></span><input type="text" class="textbox" id="pinText" name="pinText" onblur="checkpinEmptyworker(this.value.length);" placeholder="Enter 6 digit PIN/ZIP code" onKeyUp="pinValidworker(this.value);" maxlength="6"/>
                 
            
             
            
            	<label class="label">Id Proof:</label> <input type="file" class="file" id="idpic" onchange="previewidPic(this);" name="idpic"/>
                <div class="previewidimageDiv previewimageDiv"></div>
            
            	
            
            	<label class="label">Profile pic:</label> <input type="file" class="file" id="profilepic" onchange="previewprofilePic(this);" name="profilepic"/>
                <div class="previewprofileimageDiv previewimageDiv"></div>
                 
            
            
            
            	<label class="label">Website:</label> <input type="text" class="textbox" id="websiteText" name="websiteText" value="http://"/> 
         	
            
            	<label class="label">Email:</label>  <span id="emailemptyspan"></span><br /><input type="text" class="textbox" id="emailText" name="emailText" onkeyup="emailValid(this.value);" />
                                    
            	<input type="submit" class="button" name="submit" id="submitUpdate" value="Update"/>
           
   		</div>
		 </form>
        
	</div>
    
 <div class="alert" id="updateAlert">
 	<p>Your details have been succesfully updated</p>
 </div>
 
 <div class="alert visitedcountalert" id="visitedcountAlert">
 	<p></span>Profile Views:<span id="visitedcountspan"></p>
    <input type="button" value="Ok" class="button okbutton" onclick="closeAlert(visitedcountAlert);" />
 </div>
 
	<div class="centerDiv"> 
	       
        <div class="circlesDiv">
        	<div class="circles_subDiv" onclick="showprofileeditDiv();">
                	<div class="circles_subImgDiv" id="editprofileImgDiv"></div>
                    <div class="circles_subLabelDiv"><label>Edit Profile</label></div>
            </div>
            <div class="circles_subDiv" onclick="showVisitedCount();">
                	<div class="circles_subImgDiv" id="viewedImgDiv"></div>
                    <div class="circles_subLabelDiv"><label>Profile Views</label></div>
            </div>
            <a onclick="changeLoc('searchworkDiv');"><div class="circles_subDiv">
                	<div class="circles_subImgDiv" id="jobImgDiv"></div>
                    <div class="circles_subLabelDiv"><label>Search Work</label></div>
            </div></a>
        </div>
        
        <div id="workdetailsDiv" class="detailsDiv">
            <img src="Images/cross.png" width="25" height="25" style="position:absolute;top:0;right:0%;cursor:pointer;" onclick="closeDetails();" />
            Name:<span id="nameSpan" class="textbox"></span><br /><br />
            Mobile:<span id="mobileSpan" class="textbox"></span><br /><br />
            Resd. Addr.<br /><textarea id="readaddr" cols="20" rows="5" disabled="disabled"></textarea><br />
            SMS:<br /><textarea id="smstextarea" cols="20" class="textarea" rows="5">Service required:</textarea><br />
            <input type="button" class="tablebutton"  name="smssend" value="Send SMS" onclick="sendSMS();" />
        </div>

        <div id="searchworkDiv" class="tableDiv">
        		<div class="headingtableDiv">Search Work</div>
                <table class="table">
                              
                <tr>
                    <td>State:<select id="stateText" class="stateText combo" name="stateText" onchange="fillcities(this.value);">
                                    <option value="select">Select</option>
                                </select>
                    </td> 
                </tr>
                
                 <tr>
                    <td>City: <select id="cityText" name="cityText" class="combo">
                                    <option value="select">Select</option>
                              </select>
                    </td> 
                <tr>
                    <td> <a onclick="changeLoc('worktableDiv');"><input type="button" class="tablebutton" name="search" id="search" value="Search" onclick="searchwork();" /></a>
                </tr>
    
                </table>
                
                
                    
                </div>
                <div id="worktableDiv" class="tableDiv">
                	<div class="headingtableDiv"><label>Available works</label><div class="closeDiv" onclick="closeDiv1(worktableDiv)"></div>
                    </div>
                    <table class="table" id="worktable">
                    </table>
                </div >
    	<?php include_once("footer.html") ?>
        </div>
        
    </div>    
	
<script src="jquery-1.8.2.min.js"></script>
<script src="processing.js"></script>
<script>
			
	
	function searchwork()
	{
		$('#worktableDiv').slideDown();
		doFetchAll();
		
	}
	
	function doFetchAll()
		{
			var tr;
			var state = $('#stateText').val();
			var city = $('#cityText').val();
			//alert(uid);
			var uid ="<?php echo $_SESSION['uid'] ?>";
			$.ajax({
			type:"GET",
			dataType:"JSON",
			url:"searchwork.php?state="+state+"&city="+city+"&uid="+uid,
			contentType:"application/json;charset=utf-8",
			success:function(data)
				{
					
					//alert(JSON.stringify(data));
					$("#worktable").empty();
					$("#worktable").append("<tr><th>Rid</th><th>Location</th><th>Last Date</th><th>Specialization Required</th><th>Details</th></tr>");
					//alert(data.length);
					for(i=0;i<data.length;i++)
						{
						  var row=$('<tr>');
						  row.append("<td>"+data[i].rid+"</td>");
						  row.append("<td>"+data[i].workaddr+"</td>");
						  row.append("<td>"+data[i].reqdate+"</td>");
						  row.append("<td>"+data[i].spec+"</td>");
						  row.append("<td><center><img src='Images/details.jpeg' id='"+data[i].rid+"' width=100 height=50 style='cursor:pointer;' onClick='showDetails(id);'></td>");
						  $("#worktable").append(row);
						}
				}
					});
		}
		var mob;
		function showDetails(rid)
		{
			
			$('#workdetailsDiv').fadeIn('slow');	
			$.ajax(
					{
   						type:'GET',
		   				url :'getworkdetails.php?rid='+rid,
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
								$("#smstextarea").val("For Service Contact:<?php echo $_SESSION["mobile"] ?>");
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
				{alert("SMS failed");}
				else
				alert(success+" "+data);
				
				});
		}
		
		function closeDetails()
		{
			$('#workdetailsDiv').hide();
		}
		
		function sendSMS()
		{
			alert("sms sent");
		}


	
	
	//*******validating user id*********//DONE
   
   
	
	//******all validations check on submit*********
/*   document.getElementById('search').addEventListener('click',function(e){
	   
	   
	   if(uidval==0)
	   {
		   alert("fields incorrect");
	  	   e.preventDefault();
	   }
	   });
	   
*/   
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
								 $(".stateText").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
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
						  }
			  
			   });
			}
			else{
				$("#cityText").empty();
				$("#cityText").append("<option value='select'>Select</option>");
				//$("#cityText").prop("autofocus","autofocus");
			}
		}
   
 	//***********************************************************EDIT PROFILE****************************************************************************8
	
	
	function showprofileeditDiv()
	{
		$('.formDiv').slideDown('slow');		
		fillDataprofile($('#uidTextprofile').val());		
	}
	
/*	$('#uidTextprofile').on('keyup',function (e)
		{      
			var count = $('#uidTextprofile').val().length;
			 if($('#uidTextprofile').val()!="")
				{
					
					var url = "checkuid.php";
					//alert(url);
   					$.ajax(
					{
   						type:'GET',
		   				url :url,
						data: {uid: $('#uidTextprofile').val(), type:'worker'} ,
						global:false,
						beforeSend: function()
							{
								$("#uidemptyspanprofile").html(" <img width='20px' height='20px' src='ssloading.gif'/>");
							},
  						success: function(data)
							{
 			   					if(data==0)
									{
										$("#uidemptyspanprofile").html(" *not found").css("color","red");
										uidval=0;
									}
								else
									{
										$("#uidemptyspanprofile").html(" found").css("color","green");
										uidval=1;
									}
			   
							},
  			 			error:function(jqXHR,textStatus,errorThrown){alert('Exeption:'+errorThrown);}
			 
						}); 
				
			}
			else
			{
				//alert(count);
				$("#uidemptyspanprofile").html("");
			}
 	
			});
	
	*/	

	var nameval=mobileval=stateval=pinval=1;
	var emailval=1;
    var global;
   //*********filling data through search button******//DONE
   function fillDataprofile(uid)
   {
		   var url = "searchworkerfill.php?uid="+uid;
		  // var city = "";
		   $.get(url,function(data,success){
			   
			   
			   var ary=data.split(";");
						if(ary.length==1)
						  alert("Invalid id");
						  else
						  {
							  $("#fieldofwork").val(ary[0]);
							  $("#exp").val(ary[1]);
							  $("#ofcaddr").val(ary[2]);
							  $("#spec").val(ary[3]);
							  $("#prevwork").val(ary[4]);
							  $("#nameText").val(ary[5]);
							  $("#mobileText").val(ary[6]);
							  $("#resdaddr").val(ary[7]);							 
							  $("#stateTextprofile").val(ary[9]);
							  fillcitiesprofile($("#stateTextprofile").val());							 
							  global=ary[8];                              
							  $("#pinText").val(ary[10]);
							  $("#websiteText").val(ary[11]);
							  $("#emailText").val(ary[12]);												  
							  $(".previewidimageDiv").css("background-image","url(workerIds/"+ary[13]+")");
							  $(".previewprofileimageDiv").css("background-image","url(workerPps/"+ary[14]+")");											  
							  
						  }
				 
			  
			   });
	
	     
   }
   
   
   
   
   //*******validating name*********//DONE
   
   function checknameEmpty(length)
   {
	   if(length==0)
	   		{
				$("#nameemptyspan").html("  *This is required").css("color","red");
				$("#nameText").css("background-image","none");
				nameval=0;
			}
		else
			$("#nameemptyspan").html("");	
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
			$("#nameemptyspan").html("");
				nameval=0;
		}
			
	}
	
	//*******validating mobile*********//Done
   

   function checkmobileEmpty(length)
   {
	   if(length==0)
	   		{
				$("#mobileemptyspan").html("  *This is required").css("color","red");
				$("#mobileText").css("background-image","none");
				mobileval=0;
			}
		else
			{
				$("#mobileemptyspan").html("  *This is required").css("color","red");	
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
			$("#mobileemptyspan").html("");
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
		
		
	function checkstateEmptyworker(val)
   {
	   if(val=='select')
	   		{
				$("#stateemptyspan_worker").html("  *This is required").css("color","red");
				stateval=0;
			}
		else
			{
				$("#stateemptyspan_worker").html("");
				stateval=1;
			}
			
   }
   
   //********validating pincode******************
   function checkpinEmptyworker(length)
   {
	   if(length==0)
	   		{
				$("#pinemptyspan_worker").html(" *This is required").css("color","red");
				$("#pinText").css("background-image","none");
				pinval=0;
			}	
		else
			$("#pinemptyspan_worker").html("");	
   }

	function pinValidworker(rec)
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
	   
	   
	   if(mobileval==0||nameval==0||emailval==0||stateval==0||pinval==0)
	   {
		   alert("fields incorrect");
	  	   e.preventDefault();
	   }
	   else
	   {
		   //$('#updateAlert').css('display','block');
		   $('#updateAlert').fadeIn("fast");
	   }
	   });
	   
	   
	   function fillstatesprofile()
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
								 $("#stateTextprofile").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 }
						  }
			  
			   });
		}
		
		 
	function fillcitiesprofile(state)
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
						  		$("#cityTextprofile").empty();								
							 for(var i=0; i<ary.length-1;i++)							 
							 {
								 $("#cityTextprofile").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 }
							 $("#cityTextprofile").val(global);
						  }
			  
			   });
			}
			else{
				$("#cityTextprofile").empty();
				$("#cityTextprofile").append("<option value='select'>Select</option>");
				//$("#cityTextprofile").prop("autofocus","autofocus");
			}
	}
	
	function fillsearchcombos()
	{						
		   var url = "fillcombos.php?type=fieldofwork";
		   $.get(url,function(data,success){
			   
			   		   var ary=data.split(";");
						if(ary.length==1)
						  {
							  alert("no worker found");
							}
						  else
						  {
							 //alert(data);	
							
							 $('#fieldofwork').empty();							 							 
							 for(var i=0; i<ary.length-1;i++)							 
							 {
								 $("#fieldofwork").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 }
						  }
			  
			   });
			   
			var url = "fillcombos.php?type=exp";
		   $.get(url,function(data,success){
			   
			   		   var ary=data.split(";");
						if(ary.length==1)
						  {
							  alert("no worker found");
							}
						  else
						  {
							 //alert(data);	
							 $("#exp").empty();		
							 for(var i=0; i<ary.length-1;i++)							 
							 {
								 $("#exp").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 }
						  }
			  
			   });  
		
	}
   
   function previewidPic(file)
	{
		if(file.files&&file.files[0])
			{
				var reader = new FileReader();
				reader.onload=function(e){
			
				$(".previewidimageDiv").css("background-image","url("+e.target.result+")");
			}	
			reader.readAsDataURL(file.files[0]);
			}
	}

	function previewprofilePic(file)
	{
		if(file.files&&file.files[0])
			{
				var reader = new FileReader();
				reader.onload=function(e){
			
				$(".previewprofileimageDiv").css("background-image","url("+e.target.result+")");
				}	
				reader.readAsDataURL(file.files[0]);
			}
	}
	
	function closeDiv()
	 {
		 $(".formDiv").fadeOut("slow");
	 }
	 
	 function closeDiv1(id)
	 {
		 $(id).slideUp();
	 }
	 
	 //*******************************************************VISITED PROFILE COUNT***************************************************************
	 function showVisitedCount()
	 {
		 var uid="<?php echo $_SESSION["uid"]?>";
		 var url = "profilevisitedcount.php?uid="+uid;			  
		  		 $.get(url,function(data,success)
				{
						$('#visitedcountspan').html(" "+data);
			   			$('#visitedcountAlert').css('display','block');
			  			
			   });
	 }
	 
	 function closeAlert(id)
	 {
		 $(id).fadeOut('slow');
	 }
	 
	 function changeLoc(id)
			{
				
				//$("html, body").animate({scrollTop:$("#"+id).offset().top},"slow");
				  $('html, body').animate({scrollTop:$('#'+id).offset().top-25},'slow');
			}
	 
</script>


</body>
</html>
