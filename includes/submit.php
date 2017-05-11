<!-- Dancing Everywhere database connection info
** Version 1.0.3
** Date Created:  07-29-2013 by Marc Longhenry
** Date		Developer				Modification Made
** -------- ----------------------- --------------------------------------------------------------
** 07-29-13	Marc Longhenry			Original File Created.
** 05-30-14 	"					Modifications made to include error logging.
** 02-17-15		"					Updated error logging to include Document Root.
**									Updated Interacts With list and associated 'includes'
**
** ----- Interacts With -----
** submit-country-list.php
** submit-style-list.php
** submit-lesson.php
**
** ----- Submits To -----
** insert_scene.php
**
*-->
<div class="submit">	
	<a href="#dances" class="close-link" ng-click="pageChange('dances')">X</a>
    <div id="submit-form-container">
        <div id="fdisc" class="fhidden">
            <h3>Submit Dance Scene Information</h3>
                <p>Thank you for submitting dance information to our website!  We greatly appreciate any and all effort our community makes to help expand our library of information.  Every scene that anyone submits to us means there is a greater possibility that someone new may get into dancing, someone who just moved nearby may come dance with you, you may find a new dance you like, or so so much more!</p>
                <p>That being said, please ask the scenes you add if you can add them!  I know I would like a global database of every dancing scene everywhere, but some people may be uncomfortable with having their scene listed here and that is O.K.  If it is something you don't feel comfortable asking them about, send us the information at Requests(at)dancingeverywhere(dot)com and make the subject line something like "New Scene" and we will try to reach out to them about it.</p>
                <p>If you find that your scene is up here already and there is a mistake in our information, you did not want your information on this site, or you are the leader of the scene and would like to be the one updating the information please e-mail us at Requests(at)dancingeverywhere(dot)com and make the subject line something along the lines of "Need to Change information for London Salsa Screw" and we will try to fix it as soon as we are able.</p>
        </div> <!-- Disclaimer Form (fdisc) -->
		<div id="sscene" class="main-section">
            <div id="scene-info-form">
                <form id="dance-submission-form" action="../../includes/insert_scene.php" method="post">
                    <div id="scene-information">
						<label for="responsible">Contribution:</label>  What is your purpose in contributing this scene and its information to our website?
						<div class="contribution-item float_left"><input type="radio" name="submission" value="community" checked ><b><-- Community</b><br />
							This segment is for those who are just contributing information on dancing they have found!</div>  <!-- Contribution Item 1 -->
						<div class="contribution-item float_right"><input type="radio" name="submission" value="organizer"><b><-- Organizer</b><br />
							This segment is for those who want to take responsibility for a listing on this directory.  It will require you to give us your e-mail address so we can update you with site changes, change requests from the community, and other items related to your scene.</div>  <!-- Contribution Item 2 -->
						<div id="organizer-email" class="hidden-organizer"><label for="organizerEmail">Organizer E-mail:</label><input type="email" name="organizer_email"></div>
						<label class="clear_both" for="name">Name of Scene:</label><input type="text" name="name" required="required"><br />
						This is just the name for your scene or dance.  This could just be Philadelphia Tango, or it could be Tuesday LaB for a specific dance if your scene has more than one dance a week/month.<br /><br />
						<label for="type">Type:</label>  There are A LOT of different places and groups to dance with.  Are you a Social Lindy Hop dance?  Do you have an event to dance to raise money for Cancer?  We currently don't have extra items for specific types of events such as dates and timing for Weekend Events, teaser videos for Performances, or bios and videos for Private Instructors.. These will be coming in the future!  Social Dancing is our primary goal for now, and we want to include everyone!<br />
						<select name="type">
							<option value="socialdancing">Social Dancing</option>
							<option value="dancestudio">Dance Studio</option>
							<option value="privateinstructor">Private Instructor</option>
							<option value="dancingforacause">Dancing for a Cause</option>
							<option value="weekendevent">Weekend Event</option>
							<option value="performance">Performance</option>
							<option value="other">Other</option>
						</select><br />
						<label for="website">Website:</label><input type="text" name="website" required="required"><br />
						We cannot host all the information about your scene (yet).  There is just way too much of you guys to love.  So, we recommend making a Facebook or having a website like this one.  Copy the link that will get people to more information about your dance above, so that we can forward dancers to you.<br /><br />
						<label for="description">Description:</label><textarea name="description"></textarea><br />
						Please give us a short description of your scene!
					</div>  <!-- Scene Information -->
					<div id="submit-style-and-lesson">
						<?php 	include('submit-style-list.php');
								include('submit-lesson.php'); ?>
					</div> <!-- Style and Lesson Information -->	
					<div id="submit-timing-and-location">
						<label for="timing">Timing:</label>  People only have so many days away from their hard labor at work.. When do your dances occur?  Are they on a regular day every week or the first friday of every month?  Select the "Other" option in both dropdowns to enter something manually in the textbox.<br />
						<select name="timing1">
							<option value="Every">Every...</option>
							<option value="Every Other">Every Other...</option>
							<option value="First">First...</option>
							<option value="Second">Second...</option>
							<option value="Third">Third...</option>
							<option value="Fourth">Fourth...</option>
							<option value="Fifth">Fifth...</option>
							<option value="Once A">Once A...</option>
							<option value="Twice A">Twice A...</option>
							<option value="Other">Other</option>
						</select>
						<select name="timing2">
							<option value="Sunday">Sunday</option>
							<option value="Monday">Monday</option>
							<option value="Tuesday">Tuesday</option>
							<option value="Wednesday">Wednesday</option>
							<option value="Thursday">Thursday</option>
							<option value="Friday">Friday</option>
							<option value="Saturday">Saturday</option>
							<option value="Month">Month</option>
							<option value="Year">Year</option>
							<option value="Other">Other</option>
						</select><input type="text" id="submission-timing3" name="timing3">
						<input type="hidden" name="other-timing" id="other-timing"><br /><br />
						<label for="location">Location:</label>City, State, and Country are required so that we can get a general location for your dance on a map.  It also allows for all dances worldwide instead of limiting entries to just one country.  Who wants to do that?<br />
						Also, when you are finished selecting city, state, country, and possibly an address, please click the "Check" button and verify the address you gave shows up correctly in the map below!<br />					
						<label for="address">Address:</label><input type="text" id="address" name="address"><br />
						<div class="address-item"><label for="city">City:</label><input type="text" id="city" name="city" required="required"><br /></div> <!-- Address Item 1 -->
						<div class="address-item"><label for="state">State:</label><input type="text" id="state" name="state" required="required"><br /></div>  <!-- Address Item 2 -->
						<?php include('submit-country-list.php'); ?>
						<div class="address-item" id="panel">
							<input class="btn" id="check-button" type="button" value="Check" onclick="codeAddress()">
						</div>
						<div id="map-canvas"></div>
						<input type="hidden" id="lat" name="lat" />  <!-- Storage for Latitude -->
						<input type="hidden" id="lng" name="lng" />  <!-- Storage for Longitude -->
					</div> <!-- Timing and Location DIV -->
					<input id="info-form-submit" type="submit">
				</form>
			</div>  <!-- Scene Info Form -->
		</div> <!-- Scene (sscene) -->
</div> <!-- Submit Class -->