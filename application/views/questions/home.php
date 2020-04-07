
<div class="container">
	<div id="questionList">
	<?php foreach ($questions as $question): ?> 

		<div class="panel panel-default panel-list">
			<div class="row">
				<div class='questiondiv' id="<?php echo $question['id']; ?>">
					<p class="question" id="<?php echo $question['id']; ?>">
						<span class='questionspan' id="<?php echo $question['id']; ?>">
							<?php echo $question['question']; ?>
						</span>
						<a href="#" class='edit' id=<?php echo $question['id']?>>  edit</a>
						<a href="#" class='remove' id=<?php echo $question['id']?>>  remove</a> 
						<span class="editquestion" id=<?php echo $question['id']?> style='display:none'>
							<input type='text' name='question' id=<?php echo $question['id']?>>
							<input type='button' class='btn btn-primary' name='cancel' value='cancel' id=<?php echo $question['id']?>>
							<input type='submit' class='btn btn-success' name='edit' value='edit' id=<?php echo $question['id']?>>
						</span>
					</p>
				</div>
			</div>
		</div>



	<?php endforeach ?>
</div>
<form class="form-inline" id="addQuestionForm">
<div class="form-group mr-2">
	<label for "question" >Question</label>
	
	<input type="text" name="question" id="question" class="form-control" placeholder="add a question" required/>
</div>
<div class="form-group mr-2">

	<input type="submit" class='btn btn-success' name="submit" value="add question" id="addQuestion">
	
</div>
</form>

</div>
	
<script></script>

<script>
	 
$(document).ready(function() {
	
	$("#addQuestionForm").validate({
		rules: {
			question: {
				required:true,
				minlength: 3
			}
		}
	});
	
	
	$("#addQuestionForm").submit(function(event) {
		event.preventDefault();
		var isFormValid = $("#addQuestionForm").valid();
		if (isFormValid) {
			sendQuestion();
		}
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
		

	});
	$("#questionList").on('click', "input:button", function() {
		$(this).parents("span").css('display', 'none');
	});
	$("#questionList").on('click', "input:submit", function() {
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

function sendQuestion() {
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
			" <a href='#' class='remove' id=" + addedQuestion.id + ">remove</a> </p></div>" +
			" <span class='editquestion' id=" + addedQuestion.id + " style='display:none'>" + 
			"<input type='text' name='question' id=" + addedQuestion.id + ">" +
			"<input type='button' class='btn btn-primary' name='cancel' value='cancel' id=" + addedQuestion.id + ">" +
			"<input type='submit' class='btn btn-success' name='edit' value='edit' id=" + addedQuestion.id + ">" + "</span>"
			$("#questionList").append(newQuestionHTML);
				
		/*	var $cloneDiv = $("#questionList").children().last().clone(true);
			console.log($cloneDiv);
			$cloneDiv.children().attr('id', addedQuestion.id);
			$cloneDiv.attr('id', addedQuestion.id);
			$cloneDiv.children(".questionspan #"+addedQuestion.id).text(addedQuestion.question);
			console.log($cloneDiv);
			$("#questionList").append($cloneDiv);
			*/				
			
			/*var newDiv = $("#questionList").append("div");
			newDiv.addClass('questiondiv').attr('id', addedQuestion.id);
			var newP = newDiv.append("p");
			newP.addClass('question').attr('id',addedQuestion.id);
				
					
			newP.append("span").attr('id', addedQuestion.id).text(addedQuestion.question);
			newP.append("a").addClass('edit').attr('id', addedQuestion.id).attr('href', '#').text('edit');
			newP.append("a").addClass('remove').attr('id', addedQuestion.id).attr('href', '#').text('remove');
			var editSpan = newDiv.append("span").addClass('editquestion').attr('id', addedQuestion.id).css('display:none');
				
			editSpan.append("input").attr('type','text').attr('name', 'question').attr('id', addedQuestion.id);
			editSpan.append("input").attr('type', 'button').attr('name', 'cancel').attr('value', 'cancel').attr('id', addedQuestion.id);
			editSpan.append("input").attr('type', 'button').attr('name', 'edit').attr('value', 'edit').attr('id', addedQuestion.id);
			*/
		},
	});				
};
	
 
	 </script>
