<?php echo validation_errors(); ?>
<?php echo form_open('questions/add/'); ?>

	<label for "question">Question</label>
	<input type="text" name="question" id="question">
	
	<input type="submit" name="submit" value="add question" id="addQuestion">
	
</form>


