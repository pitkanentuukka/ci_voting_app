<?php echo validation_errors(); ?>
<?php echo form_open('questions/add/'); ?>
<div class="input-group">
	<span class="input-group-addon">
	<label for "question">Question</label>
	<input type="text" name="question" id="question">
	
	<input type="submit" class='btn btn-success' name="submit" value="add question" id="addQuestion">
	</span>
</div>
</form>


