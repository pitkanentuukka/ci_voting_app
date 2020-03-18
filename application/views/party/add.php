<?php echo validation_errors(); ?>

<?php echo form_open('party/add/'); ?>

	<label for "party">Party</label>
	<input type="text" name="party">
	
	<input type="submit" name="submit" value="add party">
	
</form>
