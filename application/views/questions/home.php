
<div class="container">
	<div id="questionList">
	<?php foreach ($questions as $question): ?> 
		<div class="panel panel-default panel-list">
			<div class="row">
				<div class='questionDiv' id="<?php echo $question['id']; ?>">
					<p class="question">
						<span class='questionspan'>
							<?php echo $question['question']; ?>
						</span>
						<a href="#" class='edit'>  edit</a>
						<a href="#" class='remove'>  remove</a> 
						<form class='form-inline d-none'>
							<input type='text' name='question' value='<?php echo $question['question']; ?>' />
							<input type='button' class='btn btn-primary' name='cancel' value='cancel' />
							<input type='submit' class='btn btn-success' name='edit' value='edit' />
						</form>
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
		
	$("#questionList").on('click', ".remove", function(event) {
		event.preventDefault();
		var id = $(this).parents('div .questionDiv').attr('id');
		$.ajax({
			url: "<?php echo base_url(); ?>index.php/questions/removeAjax/" + id,
			type: 'GET',
			context: $(this),
			error: function() {
				alert("something went wrong");
			},
			success: function(response) {
				$(this).parents('div .questionDiv').remove();
			},	
		});
	});
	
	$("#questionList").on('click', ".edit", function() {
		var id = $(this).parent("div .questionDiv").attr('id');
		var question = $(this).siblings("span").html();
		console.log(question);
		var editParent = $(this).parents('p');
		editParent.find('form').removeClass('d-none');
		$(this).parents('div .questionDiv').find('form').removeClass('d-none');
		
	});
	$("#questionList").on('click', "input:button", function() {
		$(this).parents("form").addClass("d-none");
	});
	$("#questionList").on('click', "input:submit", function(event) {
		event.preventDefault();
		var id = $(this).parents('div .questionDiv').attr('id');
		
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
				$('#'+id.toString()+ ' .questionspan').text(question);
				$(this).parent('form').addClass('d-none');
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
			var newQuestionHTML = "<div class='panel panel-default panel-list'>" +
				"<div class='row'>" +
				"<div class='questionDiv' id=" + addedQuestion.id + ">" + 
				"<p class='question'>" + 
				"<span>" + addedQuestion.question + "</span>" +
				" <a href='#' class='edit'>edit</a>" +
				" <a href='#' class='remove'>remove</a> </p></div>" +
				"<form class='inline-form d-none'>" +
				"<input type='text' name='question'>" +
				"<input type='button' class='btn btn-primary' name='cancel' value='cancel'>" +
				"<input type='submit' class='btn btn-success' name='edit' value='edit'>" + "</form></p></div></div></div>"
			$("#questionList").append(newQuestionHTML);
				
		},
	});				
};
	
 
	 </script>
