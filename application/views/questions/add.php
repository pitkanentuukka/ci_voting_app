<?php echo validation_errors(); ?>

<?php echo form_open('questions/add/'); ?>

	<label for "question">Question</label>
	<input type="text" name="question">
	
	<input type="submit" name="submit" value="add question">
	
</form>
