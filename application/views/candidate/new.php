<?php echo validation_errors(); ?>
<?php echo form_open('candidate/new/'); ?>

	<label for "name">Name</label>
	<input type="text" name="name">
	<label for "number">Number</label>
	<input type="text" name="number">
	<select class="form-control">
	
	<?php
	foreach ($districts as $district) 
	{ ?>
		<option value="<?php echo $district['id']; ?>"><?php echo $district['district']; ?> </option>';
		
	<?php } ?>
			
	</select>
	
	<input type="submit" name="submit" value="add candidate">
	
</form>
