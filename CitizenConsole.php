<?php session_start() ;
			if(!isset($_SESSION["uid"])||($_SESSION["type"])!='citizen')	
			die(header("Location:index.php"));
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Citizen Console</title>
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
    <div class="formDiv">
		<div class="formheadingDiv">
    		<label>Personal details</label><div class="closeDiv" onclick="closeDiv();"></div>
    	</div>
		<form name="citizenprofileform" action="CitizenProfileSubmit.php" method="post"  enctype="multipart/form-data" class="form">

   		<div class="formfieldDiv">
   		
        	
            	<label class="label">User Id:</label><span id="uidemptyspan_profile"></span>
            
            
            	<input type="text" class="textbox readonly" name="uidText" id="uidText" readonly="readonly" value="<?php echo $_SESSION['uid'] ?>"/> 
            
                        
        	<br />
            	<label class="label">Full Name*:</label> <span id="nameemptyspanprofile"></span><br /><input type="text" class="textbox" id="nameText" onblur="checknameEmptyprofile(this.value.length);" onKeyUp="nameValidprofile(this.value);" name="nameText"/> 
         	
            
            	<label class="label">Mobile Number*:</label> <span id="mobileemptyspanprofile"></span><br /><input type="text" class="textbox" id="mobileText" name="mobileText" onblur="checkmobileEmptyprofile(this.value.length);" onKeyUp="mobileValidprofile(this.value);" />
            
      
            
            	<label class="label">Email:</label>  <span id="emailemptyspanprofile"></span><br /><input type="text" class="textbox" id="emailText" name="emailText" onkeyup="emailValidprofile(this.value);" />
            
            
            
            	<label class="label">Residential Address:</label><br /><textarea id="resdaddr" class="textarea" rows="4" cols="20" name="resdaddr">
                						</textarea><br />
                 
            
             
            	<label class="label">State*:</label> <span id="stateemptyspan_citizen"></span><br /><select id="stateText" class="combo stateText" name="stateText" onchange="fillcities(this.value,id);" onblur="checkstateEmptycitizen(this.value);">
                				<option value="select">Select</option>
                			</select>
                            
             	<br />
            	<label class="label">City*:</label> <select id="cityText" class="combo" name="cityText"><option value="select">Select</option></select>
                 
            
            	<br />
            	<label class="label">Pin*:</label> <input type="text" class="textbox" id="pinText" name="pinText" onblur="checkpinEmptycitizen(this.value.length);" placeholder="Enter 6 digit PIN/ZIP code" onKeyUp="pinValidcitizen(this.value);" maxlength="6"/>
                 
            
             
             	<fieldset class="fieldset"><legend>Occupation</legend><input type="radio" class="radio" name="occ" id="occjob" value="job" />Job <input type="radio" name="occ" id="occbusiness" class="radio" value="business" />Business</fieldset>
             
                        
            	<input type="submit" class="button" name="submit" id="submitUpdate" value="Update"/>
            
            
      
   		</div>

		</form>   
	</div>
    
	<div class="reqmaster tableDiv">
   		<img src="Images/cross.png" width="20" height="20" style="position:absolute;right:0%;cursor:pointer;" onclick="closereqmaster();" />
    	<table id="reqtable" class="table"></table>
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
            <a onclick="changeLoc('addreqDiv');"><div class="circles_subDiv" >
                	<div class="circles_subImgDiv" id="addreqImgDiv"></div>
                    <div class="circles_subLabelDiv"><label>Add Requirement</label></div>
            </div></a>
            <div class="circles_subDiv"  onclick="showreqMaster();">
                	<div class="circles_subImgDiv" id="managereqImgDiv"></div>
                    <div class="circles_subLabelDiv"><label>Manage Requiments</label></div>
            </div>
            <a onclick="changeLoc('searchworkerDiv');"><div class="circles_subDiv" >
                	<div class="circles_subImgDiv" id="searchImgDiv"></div>
                    <div class="circles_subLabelDiv"><label>Search Worker</label></div>
            </div></a>
        </div>
        
          
        <form name="citizenaddrequirement" action="addRequirement.php" method="post"  enctype="multipart/form-data">	
        <div id="addreqDiv" class="tableDiv">
        	<div class="headingtableDiv">Add Requirement</div>
            <input type="text" id="uidText" name="uidText" hidden="true" value="<?php echo $_SESSION['uid'] ?>" />
            <table  border="1px solid black" class="table searchtable">
                               
                <tr>
                    <td>Field of Work:<select id="fieldofwork" class="combo" name="fieldofwork">
                            <option value="select">Select</option>
                        </select>	
                    </td> 
                </tr>
                 <tr>
                    <td>Specialization Required:<br /><textarea id="spec" class="textarea" rows="4" cols="20" name="spec">
                                            </textarea>
                    </td> 
                </tr>
                 <tr>
                    <td>Required before:<br /><input type="date" id="lastdate" class="combo" name="lastdate" />
                    </td> 
                </tr>
                    
                <tr>
                    <td>State: <select id="stateText_addreq" name="stateText" class="combo stateText" onchange="fillcities(this.value,id);">
                                    <option value="select">Select</option>
                                </select>
                    </td> 
                </tr>
                
                 <tr>
                    <td>City:<select id="cityText_addreq" class="cityText combo" name="cityText">
                                    <option value="select">Select</option>
                              </select>
                    </td> 
                </tr>
                
                <tr>
                    <td>Pin: <input type="text" id="pinText_addreq" class="combo"  name="pinText"/>
                    </td> 
                </tr>
                  <tr>
                    <td>Location:<br /><textarea id="workaddr" rows="4" class="textarea" cols="20" name="workaddr">
                                       </textarea>
                    </td> 
                </tr>
                     
                <tr>
                    <td> <input type="submit" name="post" class="button tablebutton" id="post" value="Post" /> 
                </tr>
                
               
                </table>
        </div>
        </form>
   
    
        <div id="workdetailsDiv" class="detailsDiv">
            <img src="Images/cross.png" width="25" height="25" style="position:absolute;top:0;right:0%;cursor:pointer;" onclick="closeDetails();" />
            Name: <span id="nameSpan" class="textbox"></span><br /></br>
            Mobile: <span id="mobileSpan" class="textbox"></span><br /></br>
            Residential Address<br/><textarea id="readaddr" cols="20" rows="5" class="textarea" disabled="disabled"></textarea><br />
            SMS:<br /><textarea id="smstextarea" cols="20" class="textarea" rows="5">Service required:</textarea><br />
            <input type="button" class="tablebutton"  name="smssend" value="Send SMS" onclick="sendSMS();" />
        </div>
     
    
        <div id="searchworkerDiv" class="tableDiv">
                <div class="headingtableDiv">Search Worker</div>
                <table  border="1px solid black" class="table">                
                
                <tr>
                    <td>State:</td>
                    
                    </tr><tr>
                    <td> <select id="stateText_searchworker" class="stateText combo" name="stateText" onchange="fillcities(this.value,id);">
                                    <option value="select">Select</option>
                                </select>
                    </td> 
                </tr>
                
                 <tr>
                    <td>City:</td></tr><tr><td> <select id="cityText_searchworker" class="cityText combo" name="cityText">
                                    <option value="select">Select</option>
                              </select>
                    </td> 
                
                
                <tr>
                    <td>Type:</td></tr><tr><td> <select id="fieldofwork_searchworker" class="fieldofwork combo" name="fieldofwork" >
                                    <option value="select">Select</option>
                                </select>
                    </td> 
                </tr>
                
                <tr>
                    <td>Exp>=</td></tr><tr><td> <select id="exp" class="expTex combo" name="exp" >
                                    <option value="select">Select</option>
                                </select>
                    </td> 
                </tr>
                
                <tr>
                    <td><a href="#worktableDiv"> <input type="button" name="search" id="search" value="Search" onclick="searchworker();" class="button tablebutton" /></a>
                </tr>
                
                </table>
               
                
         </div >
         <div id="worktableDiv" class="tableDiv">
                	<div class='headingtableDiv'>Workers List</div>
                    <table class="table" id="worktable">
                    </table>
                </div>
         <?php include_once("footer.html") ?>                       
         </div>
 
	</div>    
 
	   
    
<script src="jquery-1.8.2.min.js"></script>
<script src="processing.js"></script>

<script> 
	
	//**************************************************************ADD REQUIREMENT*************************************************************
	
	
	
	function showreqMaster()
	{

		$('.reqmaster').slideDown("slow");
		doFetchAll();
		
	}
	
	function doFetchAll()
		{
			var tr;
			var uid = "<?php echo $_SESSION['uid'] ?>";
			$.ajax({
			type:"GET",
			dataType:"JSON",
			url:"reqmasterjson.php?uid="+uid,
			contentType:"application/json;charset=utf-8",
			success:function(data)
				{
					
					//alert(JSON.stringify(data));
					$("#reqtable").empty();
					$("#reqtable").append("<tr><th>rid</th><th>type</th><th>spec</th><th>date</th><th>delete</th></tr>");
					//alert(data.length);
					for(i=0;i<data.length;i++)
						{
						  var row=$('<tr>');
						  row.append("<td>"+data[i].rid+"</td>");
						  row.append("<td>"+data[i].typeofwork+"</td>");
						  row.append("<td>"+data[i].spec+"</td>");
						  row.append("<td>"+data[i].reqdate+"</td>");
						  row.append("<td><img src='Images/delete.png' id='"+data[i].rid+"' width=100 height=50 onClick='doDel(id);'></td>");
						  $("#reqtable").append(row);
						}
				}
					});
		}
		
	function doDel(rid)
	{
	//alert(uid);
		var url = "deletereq.php?rid="+rid;
		$.get(url,function(data,success){
		
		//alert(data+success);
		doFetchAll();
	});
	}
	
	function closereqmaster()
	{
		//alert("");
		$('.reqmaster').slideUp("fast");
	}
	
    
	
	//******all validations check on post*********
	document.getElementById('post').addEventListener('click',function(e){
	   
	   
	   
	});
	   
	   
	   
	//**********************************************************************SEARCH WWORKER****************************************************************	
		
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
							 $("#fieldofwork_searchworker").empty();
							 $('#fieldofwork').empty();
							 $("#fieldofwork_searchworker").append("<option value='select'>Select</option>");									
							 $("#fieldofwork").append("<option value='select'>Select</option>");									
							 for(var i=0; i<ary.length-1;i++)							 
							 {
								 $("#fieldofwork_searchworker").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
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
							 $("#exp").append("<option value='select'>Select</option>");																
							 for(var i=0; i<ary.length-1;i++)							 
							 {
								 $("#exp").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 }
						  }
			  
			   });  
		
	}
		
   	
	function searchworker()
	{
		$('#worktableDiv').show();
		var tr;
		//alert(uid);
		var state = $('#stateText_searchworker').val();
		var city = $('#cityText_searchworker').val();			
		var fieldofwork = $('#fieldofwork_searchworker').val();
		var expr = $('#exp').val();						
		$.ajax({
				  type:"GET",
				  dataType:"JSON",
				  url:"searchworker.php?state="+state+"&city="+city+"&fieldofwork="+fieldofwork+"&exp="+expr,
				  contentType:"application/json;charset=utf-8",
				  success:function(data)
						{
							
							
							$("#worktable").empty();
							$("#worktable").append("<tr><th>Name</th><th>Type</th><th>Mobile</th><th>Details</th></tr>");
							//alert(data.length);
							for(i=0;i<data.length;i++)
								{

								  var row=$('<tr>');
								  row.append("<td>"+data[i].name+"</td>");
								  row.append("<td>"+data[i].fieldofwork+"</td>");
								  row.append("<td>"+data[i].mobile+"</td>");									  
								  row.append("<td><center><img src='Images/details.jpeg' id='"+data[i].uid+"' width=100 height=50 onClick='doDetails(id);'></center></td>");
								  $("#worktable").append(row);
								}
						}
				});
				
		
	}
		var mob;
		function doDetails(uid)
		{
			//alert(rid);
			$('#workdetailsDiv').show();	
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
								$("#smstextarea").val("Service required by:\n"+data[0].name+"\nContact:<?php echo $_SESSION["mobile"] ?>");
							}
  			 			//error:function(jqXHR,textStatus,errorThrown){alert('Exeption:'+errorThrown);}
			 
						});
			
		}
   		
		function sendSMS()
		{
			alert(mob);
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
		
	//**************************************************************EDIT PROFILE SCRIPT********************************************************************		
/*	$('#uidText').on('keyup',function (e){       
		
		
			 if($('#uidText').val()!="")
				{
					var url = "checkuid.php";
			//alert(url);
   				$.ajax({
   				type:'GET',
   				url :url,
				data: {uid: $('#uidText').val(), type:'citizen'} ,
				global:false,
  				success: function(data) {
 			   			
			   			if(data==0)
							{
								$("#uidemptyspan_profile").html(" *not found").css("color","red");
								uidval=0;
							}
						else {
								$("#uidemptyspan_profile").html(" found").css("color","green");
								uidval=1;
							}
			   
					},
  			 error:function(jqXHR,textStatus,errorThrown){alert('Exeption:'+errorThrown);}
			 
				}); 
				
			}
			else
			{
				$("#uidemptyspan_profile").html("");
			}
 	
	});
	*/		
	function showeditprofilePopup()
	{
		$(".formDiv").css("display","block");	
		fillDataprofile($('#uidText').val());
	}
	
	var nameval=mobileval=stateval=pinval=1;
	var emailval=1;
    var global;
	
	function fillDataprofile(uid)
	{	
		   var url = "searchcitizenfill.php?uid="+uid;
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
					fillcities($("#stateText").val(),'stateText');
					global = ary[4];					
					$("#pinText").val(ary[6]);
					
					if(ary[7]=="job")
					  document.getElementById('occjob').checked=true;
					  else if(ary[7]=="business") 
                      document.getElementById('occbusiness').checked=true;
				   // $("#idpic").val(ary[13]);
				   //$("#profilepic").val(ary[12]);							  
													
			    }
			  
			});			   
	  	   
    }
   
   
   
   //*******validating name*********//DONE
   
   function checknameEmptyprofile(length)
   {
	   if(length==0)
	   		{
				$("#nameemptyspanprofile").html("  *This is required").css("color","red");
				$("#nameText").css("background-image","none");
				nameval=0;
			}
		else
			{
				$("#nameemptyspanprofile").html("");
			}
			
   }

	function nameValidprofile(rec)
	{
	//alert(rec);
	if(rec!="")
		{
			var reg = /^([a-zA-Z]{1}[a-zA-Z'\s]{0,69})$/;
			//alert(reg.test(rec));
			if(reg.test(rec))
			{
				//$("#UseridTextGood").html("Valid").css("color","green");
				//$("#nameemptyspanprofile").html("Okay").css("color","green");
				$("#nameText").css("background-image","url(Images/tick.png)");
				nameval=1;
				
			}
			else
			{
				//$("#nameemptyspanprofile").html("not a valid name").css("color","red");
				$("#nameText").css("background-image","url(Images/wrong.png)");
				nameval=0;
			}
			
		}
		else 
		{
			//$("#nameemptyspanprofile").html("");
			$("#nameText").css("background-image","none");
			nameval=0;
		}
			
	}
	
	//*******validating mobile*********//Done
   
   function checkmobileEmptyprofile(length)
   {
	   if(length==0)
	   		{
				$("#mobileemptyspanprofile").html("  *This is required").css("color","red");
				$("#mobileText").css("background-image","none");
				mobileval=0;
			}
		else
			$("#mobileemptyspanprofile").html("");
   }

	function mobileValidprofile(rec)
	{
	//alert(rec);
	if(rec!="")
		{
			var reg = /^[7-9]{1}[0-9]{9}$/;
			//alert(reg.test(rec));
			if(reg.test(rec))
			{
				//$("#UseridTextGood").html("Valid").css("color","green");
				//$("#mobileemptyspanprofile").html("Okay").css("color","green");
				$("#mobileText").css("background-image","url(Images/tick.png)");
				mobileval=1;
				
			}
			else
			{
				//$("#mobileemptyspanprofile").html("not a valid phone no.").css("color","red");
				$("#mobileText").css("background-image","url(Images/wrong.png)");
				mobileval=0;
			}
			
		}
		else 
		{
			//$("#mobileemptyspanprofile").html("");
			$("#mobileText").css("background-image","none");
			mobileval=0;
		}
			
	}
	
	//*******validating email*********//

	function emailValidprofile(rec)
	{
	//alert(rec);
	if(rec!="")
		{
			var reg = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
			//alert(reg.test(rec));
			if(reg.test(rec))
			{
				
				//$("#emailemptyspanprofile").html("Okay").css("color","green");
				$("#emailText").css("background-image","url(Images/tick.png)");
				emailval=1;
				
			}
			else
			{
				//$("#emailemptyspanprofile").html("not a valid email").css("color","red");
				$("#emailText").css("background-image","url(Images/wrong.png)");
				emailval=0;
			}
			
		}
		else 
		{
			//$("#emailemptyspanprofile").html("");
			$("#emailText").css("background-image","none");
			emailval=1;
		}
			
	}
	
	function checkstateEmptycitizen(val)
   {
	   if(val=='select')
	   		{
				$("#stateemptyspan_citizen").html("  *This is required").css("color","red");
				stateval=0;
			}
		else
			{
				$("#stateemptyspan_citizen").html("");
				stateval=1;
			}
			
   }
   
   //********validating pincode******************
   function checkpinEmptycitizen(length)
   {
	   if(length==0)
	   		{
				$("#pinemptyspan_citizen").html(" *This is required").css("color","red");
				$("#pinText").css("background-image","none");
				pinval=0;
			}	
		else
			$("#pinemptyspan_citizen").html("");	
   }

	function pinValidcitizen(rec)
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
		
	document.getElementById('submitUpdate').addEventListener('click',function(e){
	   
	   
	   if(mobileval===0||nameval==0||emailval==0)
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
		
		
	function closeDiv()
	{
		$(".formDiv").css("display","none");
	}
			
		
	//**************************************************************COMMON*******************************************************************************
	
	
	
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
		
		 
	   function fillcities(state,id)
		{
			//alert(id+state);
			if(state!="select")
			{
				 var url = "fillcombos.php?type=cities&state="+state;			  
		  		 $.get(url,function(data,success)
				{
			   
			   		   var ary=data.split(";");
						if(ary.length==1)
						  alert("error is there"+data);
						else
						  {
							//  alert(id+'\ncityText_addreq');
							  if(id == 'stateText_addreq')
							 	{
									// alert("hi");
								 	$("#cityText_addreq").empty();								
							 		for(var i=0; i<ary.length-1;i++)							 
									 {
								 		$("#cityText_addreq").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 			}
							 	}
							 else if(id == 'stateText_searchworker')
							 	{
									 $("#cityText_searchworker").empty();								
							 		for(var i=0; i<ary.length-1;i++)							 
							 		{
								 		$("#cityText_searchworker").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 		} 
							 	}
							  else if(id == 'stateText')
							 	{
									 $("#cityText").empty();								
							 		for(var i=0; i<ary.length-1;i++)							 
							 		{
								 		$("#cityText").append("<option value='"+ary[i]+"'>"+ary[i]+"</option>");
							 		} 
									 $("#cityText").val(global);
							 	}
							  
						  }
			  
			   });
			}
			else{
				if(id=="stateText_addreq")
				{
				$("#cityText_addreq").empty();
				$("#cityText_addreq").append("<option value='select'>Select</option>");
				//$("#cityText_addreq").prop("autofocus","autofocus");
				}
				else if(id=="stateText_searchworker")
				{
					
					$("#cityText_searchworker").empty();
				$("#cityText_searchworker").append("<option value='select'>Select</option>");
				}
				else if(id=="stateText")
				{
					$("#cityText").empty();
				$("#cityText").append("<option value='select'>Select</option>");
				}
				
			}
		}	
		
		
		function changeLoc(id)
			{
				
				//$("html, body").animate({scrollTop:$("#"+id).offset().top},"slow");
				  $('html, body').animate({scrollTop:$('#'+id).offset().top-25},'slow');
			}
 
</script>


</body>
</html>
