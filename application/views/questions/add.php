<?php echo validation_errors(); ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php echo form_open('questions/add/'); ?>

	<label for "question">Question</label>
	<input type="text" name="question" id="question">
	
	<input type="submit" name="submit" value="add question" id="addQuestion">
	
</form>


 <script>
	 
$(document).ready(function() {
	$("#addQuestion").click(function(event) {
		event.preventDefault();
		var data = $("#question").serialize();
		//alert(data);
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/questions/addAjax/",
			type: 'POST',
			data: data,
			error: function() {
				alert("something went wrong");
			},
			success: function(response) {
				$("#questionlist").append("<p>" + response + "</p>");
				
			}
		});
				
				
	 });
 
 
 });
 
	 </script>
