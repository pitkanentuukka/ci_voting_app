  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/voting_machine.css">
<div id="questionList">
<?php foreach ($questions as $question): ?> 
<div class='questiondiv' id="<?php echo $question['id']; ?>">
<p class="question" id="<?php echo $question['id']; ?>">
<span class='questionspan' id="<?php echo $question['id']; ?>">
<?php echo $question['question']; ?>
</span>
<a href="#" class='edit' id=<?php echo $question['id']?>>  edit</a>
<a href="#" class='remove' id=<?php echo $question['id']?>>  remove</a> 
<span class="editquestion" id=<?php echo $question['id']?> style='display:none'>
<input type='text' name='question' id=<?php echo $question['id']?>>
<input type='button' name='cancel' value='cancel' id=<?php echo $question['id']?>>
<input type='submit' name='edit' value='edit' id=<?php echo $question['id']?>>
</span>
</p>
</div>
<?php endforeach ?>
</div>
<script>
	 
$(document).ready(function() {
	$("#addQuestion").click(function(event) {
		event.preventDefault();
		var data = $("#question").serialize();
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/questions/addAjax/",
			type: 'POST',
			data: data,
			error: function() {
				alert("something went wrong");
			},
			success: function(response) {
				addedQuestion = JSON.parse(response);

				var newQuestionHTML = "<div class='questiondiv' id=" + addedQuestion.id + ">" + 
				"<p class='question' id=" + addedQuestion.id + ">" + 
				"<span id=" + addedQuestion.id + ">" + addedQuestion.question + "</span>" +
				" <a href='#' class='edit' id=" + addedQuestion.id + ">edit</a>" +
				" <a href='#' class='remove' id=" + addedQuestion.id + ">remove</a> </p></div>"				
				$("#questionList").append(newQuestionHTML);
			}
		});				
	 });
	
	$("#questionList").on('click', ".remove", function() {
		var id = $(this).attr('id');
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/questions/removeAjax/" + id,
			type: 'GET',
			context: $(this),
			error: function() {
				alert("something went wrong");
			},
			success: function(response) {
				$(this).parent('p').parent('div').remove();
			},	
		});
	});
	
	$("#questionList").on('click', ".edit", function() {
		var id = $(this).attr('id');
		var question = $(this).siblings("span").html();
		$(this).siblings(".editquestion").css('display', 'block');
		$(this).siblings(".editquestion").children("input:text").val(question);
		//$(this).parent("p").hide();
		

	});
	$("#questionList").on('click', "input:button", function() {
		$(this).parents("span").css('display', 'none');
	});
	$("#questionList").on('click', "input:submit", function() {
		//$(this).parents("span").css('display', 'none');
		var id = $(this).attr('id');
		var question = $(this).siblings(':text').val();
		
		
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/questions/updateAjax/",
			type: 'POST',
			data: {id: id, question: question},
			context: $(this),
			error: function() {
				alert("something went wrong");
			},
			success: function(response) {
				$(this).parent('span').css('display', 'none');
				$('#'+id.toString()+ ' .questionspan').text(question);
			},	
		});
	});


 });
 
	 </script>
