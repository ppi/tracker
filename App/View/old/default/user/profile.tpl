	<span class="edit-ppic" onclick="editProfile('editprofileimage', '{$aUserInfo.id}', 'Edit Profile Image', '200', '200');">Edit</span>		
	<span class="edit-hobbies" onclick="editProfile('edithobbies', '{$aUserInfo.id}', 'Edit Hobbies', '200', '200');">Edit</span>	
	<span class="edit-about" onclick="editProfile('editabout', '{$aUserInfo.id}', 'Edit About', '200', '200');">Edit</span>	
	<span class="edit-worke" onclick="editProfile('editworkex', '{$aUserInfo.id}', 'Edit Work Experience', '200', '200');">Edit</span>	
	<span class="edit-education" onclick="editProfile('editeducation', '{$aUserInfo.id}', 'Edit Education', '200', '200');">Edit</span>
	<span class="edit-lang" onclick="editProfile('editlang', '{$aUserInfo.id}', 'Edit Languages', '200', '200');">Edit</span>
	<span class="edit-contact" onclick="editProfile('editcontact', '{$aUserInfo.id}', 'Edit Contact Details', '400', '200');">Edit</span>

	<div class="nameflash"></div>
	
	<div class="relater" id="relate">
	
		<div class="name" id="name">
			<h1 class="name">{$aUserInfo.first_name} {$aUserInfo.last_name}</h1>
			<h3 class="prot">{$aUserInfo.profession_choice}</h3>
		</div>
			
		<div id="ppic" class="ppic" id="ppic">
			<span class="headers">Profile Picture</span>
			<img id="profilepic" src="{$baseUrl}images/profilephoto1.png" class="profilepic"/>		
		</div>
		
		<div id="contactdetails" class="contactdetails" id="contactdetails">	
			<span class="headers">Contact Details</span>	
			<span class="address">
				Address:			
			</span>
			<span class="address-answer"> 
				{$aUserInfo.address}
				{$aUserInfo.town}
				{$aUserInfo.postcode}
			</span>
			<span class="telephone">
			Telephone:			
			</span>
			<span class="telephone-answer">
				{$aUserInfo.telno}			
			</span>	
			<span class="mobile">
			Mobile:			
			</span>
			<span class="mobile-answer">
				{$aUserInfo.mobno}
			</span>	
			<span class="email">
			Email:			
			</span>	
			<span class="email-answer">
				{$aUserInfo.email}			
			</span>		
		</div>
		
		<div class="lang" id="lang"><span class="headers">Known Languages</span>

			<table class="lang-answer">
				{foreach from=$aLanguages key=langKey item=aLang}
				<tr>
					<td>{$aLang.name}</td><td>Fluent</td>
				</tr>
		
				<!-- $aLang.slevel *}-->
			{/foreach}
			</table>
		</div>
		
		<div class="about" id="about">

		<span class="headers">About User</span>
			<span class="about">{$aUserInfo.about}</span>			
		</div>		
		<div class="worke" id="worke">

			<span class="headers">Work Experence</span>		
			<span class="wexperence-answer">{$aUserInfo.workexperence}</span>
		</div>		
		<div class="education" id="education">		

			<span class="headers">Education</span>
			<span class="education-answer">{$aUserInfo.education}</span>
		</div>
		<div class="hobbies" id="hobbies">	

			<span class="headers">Hobbies and Interests</span>		
			<span class="hobbies-answer">{$aUserInfo.hobbies}</span>
		</div>
	</div>
	<div id="form_editprofile" style="visibility:hidden; width: 490px;">
		 <div id="editprofile" style="visibility: visible;"> 	</div>
	</div>		