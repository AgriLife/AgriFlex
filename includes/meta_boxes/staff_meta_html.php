
	<h4>Details</h4>
	<label for="position">Position</label>
	<input type="text" id="position" name="<?php if(!empty($meta['position'])) echo $meta['position']; ?>" value="<?php if(!empty($meta['position'])) echo $meta['position']; ?>" placeholder="12345" size="25" />
	
	<label for="room">Building/Room</label>
	<input type="text" id="room" name="<?php if(!empty($meta['room'])) echo $meta['room']; ?>" placeholder="Building 555 Room 323" size="25" />	
